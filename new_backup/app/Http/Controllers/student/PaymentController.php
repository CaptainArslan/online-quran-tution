<?php

namespace App\Http\Controllers\student;

use App\Models\Coupon;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Plan;
use App\Models\Subscription;
use App\Traits\PayPalPlansApi;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    public function index($id)
    {
        $id = base64_decode($id);
        return view('student.payments.payments', get_defined_vars());
    }

    public function create(Request $request)
    {
        $plan = Plan::find($request->plan_id);

        $new_price = $plan->price_per_month - $plan->discount;

        if ($request->promo != '') {
            $promo = Coupon::where('code', $request->promo)->first();

            if ($promo != '') {
                $new_price = $new_price - $promo->discount_value;

                $inquiry = Inquiry::find($request->inquiry_id);
                $inquiry->coupon = $promo->code;
                $inquiry->save();
            }
        }

        $client = new \GoCardlessPro\Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);
        //go cardless code  start

        $redirectFlow = $client->redirectFlows()->create([
            'params' => [
                'description' => 'GoCardless Hosted Pages',
                'session_token' => 'client_redirected_to subscription',
                'success_redirect_url' => route('student.redirection_to_gocardless', [$plan->id, $new_price, $request->inquiry_id]),
            ],
        ]);

        if ($redirectFlow) {
            return redirect($redirectFlow->redirect_url);
        }

        // end go cardless payments
    }

    public function redirection_to_gocardless(Request $request, $plan_id, $new_price, $inquiry_id)
    {
        $plan = Plan::find($plan_id);

        $client = new \GoCardlessPro\Client([
            'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);
        $redir = $client->redirectFlows()->complete($request->redirect_flow_id, [
            'params' => ['session_token' => 'client_redirected_to subscription'],
        ]);
        if ($redir) {
            $subscriptions = $client->subscriptions()->create([
                'params' => [
                    'amount' => $new_price * 100,
                    'name' => $plan->name,
                    'currency' => 'GBP',
                    'interval_unit' => 'monthly',
                    'day_of_month' => '',
                    'links' => [
                        'mandate' => $redir->links->mandate,

                    ],
                ],
            ]);

            $subscription = Subscription::create([
                'subscription_name' => $subscriptions->name,
                'amount' => $subscriptions->amount / 100,
                'create_date' => $subscriptions->created_at,
                'currency' => $subscriptions->currency,
                'mandate' => $subscriptions->links->mandate,
                'status' => $subscriptions->status,
                'customer_id' => $redir->links->customer,
                'subscription_id' => $subscriptions->id,
                'user_id' => Auth::user()->id,
                'plan_id' => $plan_id,
                'inquiry_id' => $inquiry_id,
                'method' => 'gocardless',
                'start_date' => $subscriptions->start_date,
                'end_date' => $subscriptions->end_date,
            ]);

            //   Inquiry::where('id', $inquiry_id)->update(array('is_paid' => 1));
            Inquiry::where('id', $inquiry_id)->update([
                'is_paid' => 1,
                //     'direct_debit_start_date'=>Carbon::today()->format('Y-m-d'),
            ]);

            return view('student.thankyou');
        // return redirect()->route('student.student_inquiries')->with('message', "Thanks! Your Inquiry Payment done successfully.");
        } else {
            return redirect()->route('student.dashboard')->with('message', 'Payment not Procceded yet!.');
        }
    }

    public function createPaypal(Request $request)
    {
        $inquiry = Inquiry::find($request->inquiry_id);

        if ($request->promo != '') {
            $promo = Coupon::where('code', $request->promo)->first();
            if ($promo != '') {
                $inquiry->coupon = $promo->code;
                $inquiry->payment_method = 'paypal';
                $inquiry->save();

                return redirect()->route('student.dashboard')->with('message', "Your Promo is Validated & we'll send payment link in your mailbox.");
            } else {
                $inquiry->payment_method = 'paypal';
                $inquiry->save();

                return redirect()->route('student.dashboard')->with('message', "Your Promo is Not Valid. We'll send payment link in your mailbox");
            }
        }

        $inquiry->payment_method = 'paypal';
        $inquiry->save();

        return redirect()->route('student.dashboard')->with('message', "Thanks for Selection. We'll send payment link in your mailbox");
    }
}
