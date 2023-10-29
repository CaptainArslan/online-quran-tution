<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Models\Inquiry_Session;
use App\Models\Subscription;
use App\Models\TutorReviews;
use App\Models\User;
use Carbon\Carbon;
use GoCardlessPro\Client;
use GoCardlessPro\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function thankYou()
    {
        return view('student.thankyou');
    }

    public function student_info()
    {
        $user = Auth::user();

        return view('student.user_profile.student_profile')->with('user', $user);
    }

    public function edit_info(Request $request)
    {
        if ($request->age < 16) {
            $request->validate([
                'name' => 'required|max:190',
                'email' => 'required|max:190',
                'phone' => 'required|max:190',
                'fathername' => 'required|max:190',
                'mothername' => 'required|max:190',
                'address' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:190',
                'email' => 'required|max:190',
                'phone' => 'required|max:190',
                'address' => 'required',
            ]);
        }

        $user = Auth::user();
        $id = Auth::id();

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->age = $request->age;
        $user->fathername = $request->fathername;
        $user->mothername = $request->mothername;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->address3 = $request->address3;
        $user->save();
        // logout after changing name/email
        // Auth::logout();
        return redirect()->back()->with('message', 'Credentials changed successfully,please use new credentials to SignIn');
    }

    public function reset_password(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        $password = DB::table('users')->where('id', $id)->value('password');

        $this->validate(
            $request,
            [
                'oldpassword' => 'required',
                'newpassword' => 'required|min:8',
                'confirm_password' => 'required|same:newpassword',
            ]
        );
        if (Hash::check($request->oldpassword, $password)) {
            //add logic here

            $user->password = Hash::make($request->newpassword);
            $user->save();
            // logout after changing password
            // Auth::logout();
            return redirect()->back()->with('message', 'password changed successfully');
        } else {
            return redirect()->back()->with('message', 'Incorrect Old Password');
        }
    }

    public function logout()
    {
        Auth::logout();
        // redirect to login page after login
        return redirect('login');
    }

    public function edit_pic(Request $request)
    {
        $id = Auth::id();
        $image_path = makeImage($request->image);
        $user = User::find($id);
        $user->avatar = $image_path;
        $user->save();

        return redirect()->back();
    }

    public function student_all_session()
    {
        $list = Inquiry_Session::whereHas('inquiry', function ($q) {
            $q->where('student_id', auth()->user()->id);
        })->get();
        //$inquiry_session = Inquiry_Session::where('inquiry_id','=',$session_1)->get();
        //dd($list);
        return view('student.session.student_all_session', compact('list'));
    }

    public function session($id)
    {
        $child_id = null;
        $inq_tutor = Inquiry::where('id', base64_decode($id))->pluck('tutor_id')->first();
        $inquiry = Inquiry::where('id', base64_decode($id))->first();

        if (is_null($inq_tutor)) {
            return back()->with('error', 'No tutor has been assigned yet to inquiry. Please wait');
        }

        $tutor = User::find($inq_tutor);
        // $child_id = $inquiry->child_id;

        $conversation_id = Conversation::where('sender_id', Auth::Id())->where('receiver_id', $inq_tutor)->pluck('id')->first();
        if (is_null($conversation_id)) {
            $conversation_id = Conversation::where('receiver_id', Auth::Id())->where('sender_id', $inq_tutor)->pluck('id')->first();
        }

        if (is_null($conversation_id)) {
            $conversation_id = Conversation::create([
                'sender_id' => Auth::Id(),
                'receiver_id' => $tutor->id,
            ]);

            $conversation_id = $conversation_id->id;
        }

        $schedules = InquirySchedule::where('inquiry_id', base64_decode($id))->get();

        if (count($schedules) < 1) {
            return back()->with('error', 'No schedule has been set yet. Please wait');
        }

        //initialize array
        $Events = [];
        $week_number = date('W');
        $year = date('Y');

        for ($day = 1; $day <= 7; $day++) {
            foreach ($schedules as $s) {
                if ($day == $s['day']) {
                    $time_start = strtotime($s['time']) - ($inquiry->student_time_difference * 60);
                    $start_time = date('H:i:s', $time_start);

                    $data = date('Y-m-d', strtotime($year . 'W' . $week_number . $day)) . 'T' . /*$s['time']*/$start_time;
                    $Events[]['start'] = $data;
                }
            }
        }

        $session = Inquiry_Session::where('inquiry_id', '=', base64_decode($id))->latest()->first();
        // dd($Events);

        return view('student.session.session', get_defined_vars());
    }

    public function dashboard()
    {
        $user = User::where('id', Auth::id())->first();
        $inquiries = null;
        $start_date = null;
        if ($user->is_parent) {
            $inquiries = Inquiry::where('student_id', Auth::id())->with('child')->get();
            $start_date = Inquiry::where('student_id', Auth::id())->with('child')->where('is_paid', false)->pluck('created_at')->first();
        } else {
            $inquiries = Inquiry::where('student_id', Auth::id())->get();
            $start_date = Inquiry::where('student_id', Auth::id())->where('is_paid', false)->pluck('created_at')->first();
        }
        // Calculate remaining days of the trial
        $trialDuration = 7; // Trial duration in days
        $startDate = Carbon::parse($start_date);
        $currentDate = Carbon::now();
        $remainingDays = $startDate->diffInDays($currentDate);

        // Calculate days remaining until the end of the trial
        $daysRemaining = max(0, $trialDuration - $remainingDays);
        // dd($daysRemaining);


        return view('student.dashboard.dashboard', get_defined_vars());
    }

    public function student_inquiries()
    {
        $inquiries = Inquiry::where('student_id', Auth::id())->get();

        return view('student.inquiry.inquiries', get_defined_vars());
    }

    public function student_subscription()
    {
        $user_id = Auth::user()->id;
        $subscription = Subscription::where('user_id', $user_id)->with('child')->get();

        return view('student.subscription.list', get_defined_vars());
    }

    public function goCardlesssInfo($id)
    {
        return view('student.payments.gocardless', get_defined_vars());
    }

    public function reviews()
    {
        $reviews = TutorReviews::where('student_id', Auth::Id())->orderBy('created_at', 'DESC')->get();

        return view('student.reviews.reviews', get_defined_vars());
    }

    public function canceled_payments()
    {
        $user_id = Auth::user()->id;
        $subscription = Subscription::where('user_id', $user_id)->first();
        if (!empty($subscription)) {
            $client = new Client([
                'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
                'environment' => Environment::LIVE,
            ]);

            $mandateID = $subscription->mandate;

            $payments = $client->payments()->list([
                'params' => [
                    'mandate' => $mandateID,
                    'status' => 'cancelled',
                ],
            ]);
        }
        return view('student.subscription.cancelled', get_defined_vars());
    }

    public function reInitiatePayment($paymentId)
    {
        $client = new Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment' => env('GOCARDLESS_MODE'),
        ]);

        try {
            $payment = $client->payments()->get($paymentId);
            $plan = Subscription::where('mandate', $payment->links->mandate)->with('plan')->first();
            if ($payment->status == 'cancelled') {
                $mandateId = $payment->links->mandate;
                $mandate = $client->mandates()->get($mandateId);

                if ($mandate->status == 'active') {
                    $subscriptions = $client->subscriptions()->create([
                        'params' => [
                            'amount' => $payment->amount,
                            'name' => $plan->plan->name,
                            'currency' => $payment->currency,
                            'interval_unit' => 'monthly',
                            'day_of_month' => '',
                            'links' => [
                                'mandate' => $payment->links->mandate,
                            ],
                        ],
                    ]);
                    $subscription = Subscription::where('mandate', $payment->links->mandate)->update([
                        'status' => $subscriptions->status,
                    ]);
                    return redirect()->back()->with('message', 'Payment ReInitiated successfully. Check it in subscriptions tab');
                } else {
                    return redirect()->back()->with('message', 'This payments credentials are failed, cancelled, expired or blocked');
                }
            } else {
                return redirect()->back()->with('message', 'This payment cannot be ReInitiated.');
            }
        } catch (\Exception $e) {
            // Handle error
            return redirect()->back()->with('message', 'Failed to ReInitiated the payment.');
        }
    }
}
