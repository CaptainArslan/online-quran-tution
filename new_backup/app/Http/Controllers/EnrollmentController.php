<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Inquiry;
use App\Mail\OTP;
use App\Models\Plan;
use App\Models\Subscription;
use App\Traits\GoCardless;
use App\Traits\PayPalPlansApi;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use GoCardlessPro\Resources\RedirectFlow;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use function GuzzleHttp\Promise\settle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class EnrollmentController extends Controller
{
    use PayPalPlansApi;

    private function generateOTP()
    {
        return rand(100000, 999999);
    }
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('student.dashboard')->with('success', 'Email verified successfully.');
    }

    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('student.dashboard')->with('success', 'Email already verified.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Email verification link sent.');
    }

    public function enroll(Request $request)
    {
        $otp = $this->generateOTP();
        //      $result=Mail::to($request->email)->send(new OTP($otp));
        //      dd($request);
        $time_difference = $request->student_time_difference - (-300);
        //   dd($request->all(), $time_difference,Inquiry::first());
        $user = User::where('email', '=', $request->email)->first();

        $random_password = null;
        if (is_null($user)) {
            request()->validate([
                'name' => 'required|max:190',
                'email' => 'required|max:190|unique:users,email|email',
                'phone' => 'required|max:190',
                'password' => 'required|string|confirmed|min:8',
                /*'g-recaptcha-response' => 'required|recaptcha',*/
            ]);
            // dd($request);
            
            // user doesn't exist
            $student = new User();
            $student->name = $request->name;
            $student->email = $request->email;
            $random_password = Str::random(10);
            $student->password = Hash::make($request->password);
            $student->phone = $request->phone;
            $student->role = 'student';
            Mail::to($student->email)->send(new EmailVerification($student));
            
            $student->save();
                       Mail::to($student->email)->send(new OTP($otp));
            $user_id = $student->id;

            $lastinserted_id = $student->id;

            // $inquiry = new Inquiry();
            // $inquiry->student_id = $lastinserted_id;
            // $inquiry->status = 'pending';
            // $inquiry->student_time_difference = $time_difference;
            // $inquiry->inquiry = $request->inquiry ?? 'N/A';
            // $inquiry->save();
            // $student->sendEmailVerificationNotification();

            Auth::login($student);

            // sendMail([
            //     'view' => 'email.inquiry_mail_to_admin',
            //     'to' => 'admin_email@gmail.com',
            //     'subject' => 'New inquiry form Submitted',
            //     'name' => $student->name,
            //     'data' => [
            //         'user' => $student,
            //         'inquiry' => $inquiry,
            //     ],
            // ]);

            // sendMail([
            //     'view' => 'email.inquiry_mail_to_student',
            //     'to' => $student->email,
            //     'subject' => 'Enrollment Successfull',
            //     'name' => $student->name,
            //     'data' => [
            //         'user' => $student,
            //         'email' => $student->email,
            //         'password' => $request->password,
            //     ],
            // ]);
        } else {
            request()->validate([
                'name' => 'required|max:190',
                'email' => 'required|max:190|email',
                'phone' => 'required|max:190',
            ]);

            $user_id = $user->id;
            $inquiry = new Inquiry();
            $inquiry->student_id = $user->id;
            $inquiry->status = 'pending';
            $inquiry->student_time_difference = $time_difference;
            $inquiry->inquiry = $request->inquiry ?? 'N/A';
            $inquiry->save();
        }

        // if (Auth::check()){
        //     Auth::logout();
        // }
        // Login The Newly registered user
        Auth::loginUsingId($user_id);

        // dd(Auth::user()->id);
        // return response()->json(['inquiry_id' => base64_encode($inquiry->id)]);
        // return redirect()->route('student.gocardless.info', base64_encode($inquiry->id));
        // return redirect()->route('student.dashboard');
        return redirect()->route('student.thank.you');
    }

    public function enroll_message()
    {
        return view('enroll_message');
    }

    public function proceedPaymentPaypal(Request $request)
    {
        $inquiry_id = base64_decode($request->inquiry);
        $plan_id = base64_decode($request->plan);
        $email = base64_decode($request->email);
        $user = User::where('email', $email)->first();
        if (Auth::check()) {
            Auth::logout();
        }

        Auth::login($user);

        //$p_id = 'P-7JW45276T0402174UL52KUCI';

        return $this->paypalSubscription($plan_id, $inquiry_id);
    }

    public function payment_success(Request $request)
    {
        $uri = 'https://api.sandbox.paypal.com/v1/billing/subscriptions/' . $request->subscription_id;

        $client = new Client();
        $response = $client->get($uri, [
            'headers' => $this->header,
        ]);

        $response = json_decode($response->getBody(), true);

        $currency_code = $response['billing_info']['last_payment']['amount']['currency_code'];
        $value = $response['billing_info']['last_payment']['amount']['value'];
        $payer_id = $response['subscriber']['payer_id'];
        $next_billing_time = $response['billing_info']['next_billing_time'];
        $status_update_time = $response['status_update_time'];
        $start_time = $response['start_time'];
        $plan_id = $response['plan_id'];

        //dd($response);
        $subscription = Subscription::where('subscription_id', $request->subscription_id)->first();

        if ($response['status'] == 'ACTIVE' && $subscription == null) {
            $subscription = Subscription::create([
                'subscription_id' => $request->subscription_id,
                'user_id' => Auth()->user()->id,
                'amount' => $value,
                'create_date' => $start_time,
                'currency' => $currency_code,
                'status' => $response['status'],
                'customer_id' => $payer_id,
                'start_date' => $status_update_time,
                'end_date' => $next_billing_time,
                'method' => 'paypal',
                'paypal_plan_id' => $plan_id,
                'inquiry_id' => $request->inquiry_id,

            ]);

            Inquiry::where('id', $request->inquiry_id)->update(['is_paid' => 1]);
        }

        return redirect()->route('student.dashboard')->with('message', 'Payments done.');
    }

    public function payment_error()
    {
        return 'payment not done! Error';
    }
}
