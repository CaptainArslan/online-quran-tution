<?php

namespace App\Http\Controllers\admin;

use App\Models\Coupon;
use App\Exports\Expense;
use App\Exports\PaidPayments;
use App\Exports\PendingPayments;
use App\Exports\Revenue;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\PayOut;
use App\Models\Plan;
use App\Models\Subscription;
use App\Traits\PayPalPlansApi;
use Auth;
use Carbon\Carbon;
use DB;
use Excel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Matrix\Operators\Subtraction;

class PaymentController extends Controller
{
    use PayPalPlansApi;

    public function pending_payments(Request $request)
    {
        if ($request->status == null) {
            $pay_outs = PayOut::where('status', 'pending');
        } else {
            $pay_outs = PayOut::where('status', 'paid');
        }
        if (isset($request->from) && isset($request->to)) {
            $pay_outs = $pay_outs->whereBetween('created_at', [$request->from, $request->to]);
        } elseif (isset($request->from) && ! isset($request->to)) {
            $pay_outs = $pay_outs->where('created_at', '>', $request->from);
        } elseif (! isset($request->from) && isset($request->to)) {
            $pay_outs = $pay_outs->where('created_at', '<', $request->to);
        }
        $pay_outs = $pay_outs->get();

        if ($request->export && $request->status == null) {
            return Excel::download(new PendingPayments($pay_outs), 'pending_payments.xlsx');
        } elseif ($request->export && $request->status == 'paid') {
            return Excel::download(new PaidPayments($pay_outs), 'paid_payments.xlsx');
        }

        return view('admin.payments.pending_payments', get_defined_vars());
    }

    public function payment(Request $request)
    {
        $check = PayOut::find($request->id);
        if ($check->status == 'pending') {
            $payout = PayOut::find($request->id);
            $payout->status = 'paid';
            $payout->amount_paid = $request->amount_to_pay + $request->bonus;
            $payout->bonus = $request->bonus;
            $payout->paid_at = $request->paid_at;
            $payout->admin_note = $request->note;
            $payout->save();
            // mail tutor
            $this->payment_mail($payout->tutor->name, $payout->tutor->email, $request->amount_to_pay, $request->paid_at);

            return redirect()->back()->with('message', 'Payment Successful');
        } else {
            return redirect()->back()->with('message', 'Already Paid');
        }
    }

    public function payment_mail($name, $email, $amount, $paid_date)
    {
        sendMail([
            'view' => 'email.tutor_payments',
            'to' => $email,
            'subject' => 'Live Learning Payment Successfully Transfer',
            'name' => $name,
            'data' => [
                'user' => $name,
                'email' => $email,
                'amount' => $amount,
                'paid_date' => $paid_date,
            ],
        ]);
    }

    public function financialStatement(Request $request)
    {
        $payouts = PayOut::where('status', 'paid')->orderBy('id', 'DESC');
        $subscriptions = Subscription::orderBy('id', 'DESC');

        $expenses = DB::table('expenses')->orderBy('id', 'DESC');

        if ($request->filter_type) {
            if ($request->filter_type == 'daily') {
                $payouts->whereDate('created_at', Carbon::today()->format('Y-m-d'));
                $subscriptions->whereDate('created_at', Carbon::today()->format('Y-m-d'));
                $expenses->whereDate('created_at', Carbon::today()->format('Y-m-d'));
            }
            if ($request->filter_type == 'weekly') {
                $payouts->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                $subscriptions->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                $expenses->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if ($request->filter_type == 'monthly') {
                $payouts->whereMonth('created_at', Carbon::today()->month);
                $subscriptions->whereMonth('created_at', Carbon::today()->month);
                $expenses->whereMonth('created_at', Carbon::today()->month);
            }
        }
        if (isset($request->from) & isset($request->to)) {
            $payouts = $payouts->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59']);
            $subscriptions = $subscriptions->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59']);
            $expenses = $expenses->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59']);
        }
        $payouts = $payouts->get();
        $subscriptions = $subscriptions->get();
        $expenses = $expenses->get();

        if ($request->expense) {
            return Excel::download(new Expense($payouts), 'expense.xlsx');
        }
        if ($request->revenue) {
            return Excel::download(new Revenue($subscriptions), 'revenue.xlsx');
        }

        return view('admin.expense.financial_statement', get_defined_vars());
    }

    public function getSubscriptionDetail($id)
    {
        $subscription = Subscription::find($id);
        $data = [];

        if ($subscription->method == 'paypal') {
            try {
                $uri = 'https://api.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription->subscription_id;

                $client = new Client();
                $response = $client->get($uri, [
                    'headers' => $this->header,
                ]);

                $response = json_decode($response->getBody(), true);

                $data = [
                    'amount' => $response['billing_info']['last_payment']['amount']['value'],
                    'start_date' => $response['start_time'],
                    'currency' => $response['billing_info']['last_payment']['amount']['currency_code'],
                    'status' => $response['status'],
                    'type' => 'Paypal',
                ];
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong to get subscription details.');
            }
        }
        //gocardless
        else {
            try {
                $client = new \GoCardlessPro\Client([
                    'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
                    'environment'  => \GoCardlessPro\Environment::LIVE,
                ]);

                $response = $client->subscriptions()->get($subscription->subscription_id);

                $data = [
                    'amount' => $response->amount,
                    'start_date' => $response->start_date,
                    'currency' => $response->currency,
                    'status' => $response->status,
                    'type' => 'Gocardless',
                ];
            } catch (\Exception $th) {
                return redirect()->back()->with('error', 'Something went wrong to get subscription details.');
            }
        }

        return view('admin.student.subscription_detail', get_defined_vars());
    }

    public function cancelSub(Request $request)
    {
        $client = new \GoCardlessPro\Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);
        try {
            $client->subscriptions()->cancel($request->id);
            $subscription = Subscription::where('subscription_id', $request->id)->first();
            $inq = Inquiry::find($subscription->inquiry_id);
            $inq->update([
                'is_paid' => 0,
                'cancel_subs'=> 0,
            ]);
            $subscription->update(['status'=>'cancelled']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sorry subscription is not cancelled Please try again later;');
        }

        return redirect()->back()->with('message', 'Subscription has been cancelled successfully');
    }

    public function createPlan(Request $request)
    {
        $client = new \GoCardlessPro\Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => \GoCardlessPro\Environment::LIVE,
        ]);

        $subscription = Subscription::where('subscription_id', $request->subscription_id)->first();
        $inquiry = Inquiry::where('id', $subscription->inquiry_id)->first();
        $plan = Plan::find($request->plan_id);
        $new_price = $plan->price_per_month - $plan->discount;

        $date = $request->start_date ? Carbon::createFromFormat('Y/m/d', $request->start_date)->format('d') : '';

        $subscriptions = $client->subscriptions()->create([
            'params' => [
                'amount' => $new_price * 100,
                'name' => $plan->name,
                'currency' => 'GBP',
                'interval_unit' => 'monthly',
                'day_of_month' => $date,
                'links' => [
                    'mandate' => $subscription->mandate,

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
            'customer_id' => $subscription->customer_id,
            'subscription_id' => $subscriptions->id,
            'user_id' => $subscription->user_id,
            'plan_id' => $plan->id,
            'inquiry_id' => $inquiry->id,
            'method' => 'gocardless',
            'start_date' => $subscriptions->start_date,
            'end_date' => $subscriptions->end_date,
        ]);

        Inquiry::where('id', $subscription->inquiry_id)->update(['is_paid' => 1]);

        return redirect()->back()->with('message', 'Subscription plan has been created');
    }

    public function getAllList()
    {
    }
}
