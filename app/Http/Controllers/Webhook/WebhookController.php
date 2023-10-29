<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Log;
use PayPal\Api\Payment;
use PayPal\Api\VerifyWebhookSignature;
use PayPal\Api\WebhookEvent;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class WebhookController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $this->_api_context->setConfig(config('paypal'));
    }

    public function paypalWebhook(Request $request)
    {
        Log::notice($request->all());

        $request_body = file_get_contents('php://input');

        $respnse = json_decode($request_body, 1);

        $this->updateInquiryWebhookResponse($respnse['resource']['id']);

        exit(1);
    }

    public function gocardlessWebhook(Request $request)
    {
        $request_body = file_get_contents('php://input');
        $response = json_decode($request_body, 1);

        $resp = $response['events'][0];

        // Log::notice($resp);

        if ($resp['resource_type'] == 'subscriptions') {
            if ($resp['action'] == 'cancelled' or $resp['action'] == 'finished' or $resp['action'] == 'paused') {
                $this->updateInquiryWebhookResponse($response['events'][0]['links']['subscription']);
            }
        }
        // Log::notice($sub_id);
    }

    public function updateInquiryWebhookResponse($sub_id)
    {
        $subscription = Subscription::where('subscription_id', $sub_id)->first();
        $inq = Inquiry::find($subscription->inquiry_id);
        $inq->update([
            'is_paid' => 0,
            'cancel_subs'=> 0,
        ]);
        $subscription->update(['status'=>'cancelled']);
    }

    public function gocardlessWebhookFindCharges(Request $request)
    {
        Log::notice($request->all());
        if ($request->events[0]['action'] == 'confirmed') {
            $payment_id = $request->events[0]['links']['payment'];
            Log::notice($payment_id);
            $client = new \GoCardlessPro\Client([
                'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
                'environment'  => \GoCardlessPro\Environment::LIVE,
            ]);
            $resp = $client->payments()->get($payment_id);

            $payout_id = $resp->api_response->body->payments->links->payout;
            $subscription_id = $resp->api_response->body->payments->links->subscription;
            Log::notice($subscription_id);
            $subscription = Subscription::where('subscription_id', $subscription_id)->orderBy('created_at', 'DESC')->first();

            Subscription::create([
                'subscription_name'=>$subscription->subscription_name,
                'amount'=>$subscription->amount,
                'payment_confirmed'=>'confirmed',
                'create_date'=>now(),
                'currency'=>$subscription->currency,
                'mandate'=>$subscription->mandate,
                'status'=>'active',
                'start_date'=>now()->format('Y-m-d'),
                'customer_id'=>$subscription->customer_id,
                'subscription_id'=>$subscription_id,
                'user_id'=>$subscription->user_id,
                'plan_id'=>$subscription->plan_id,
                'inquiry_id'=>$subscription->inquiry_id,
                'method'=>$subscription->method,
            ]);
            Subscription::where('subscription_id', $subscription_id)->where('payment_confirmed', 'pending')->delete();
            Log::notice('payment created');
            $payment_id = $request->events[0]['links']['payment'];

            //  $this->findPayment($payment_id);
        }
    }

    public function findPayment($payment_id)
    {
        $client = new \GoCardlessPro\Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);
        $resp = $client->payments()->get($payment_id);

        $payout_id = $resp->api_response->body->payments->links->payout;
        $subscription_id = $resp->api_response->body->payments->links->subscription;

        $client = new \GoCardlessPro\Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);

        $pay_out = $client->payouts()->get($payout_id);
        $net_amount = $pay_out->api_response->body->payouts->amount;
        Subscription::where('subscription_id', $subscription_id)->update([
            'payment_confirmed'=>'confirmed',
            'net_amount'=>$net_amount / 100,
        ]);
    }
}
