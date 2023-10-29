<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Conversation;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Models\Inquiry_Session;
use App\Models\Subscription;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    private function generateOTP()
    {
        return rand(100000, 999999);
    }
    public function index()
    {
        $children = Children::where('parent_id', Auth::id())->with('inquiry', 'subscriptions')->get();
        // dd($children);
        return view('student.children.list', get_defined_vars());
    }

    public function create()
    {
        $id = 0;
        return view('student.children.create', get_defined_vars());
    }

    public function update($id)
    {
        $child = Children::where('id', base64_decode($id))->first();
        return view('student.children.create', get_defined_vars());
    }

    public function submit(Request $request)
    {
        if ($request->id) {
            request()->validate([
                'name' => 'required|max:190|string',
                'age' => 'required|max:190|numeric',
                'fatherName' => 'required|max:190|string',
            ]);
            // create
            $child = Children::where('id', $request->id)->first();
            $child->name = $request->name;
            $child->age = $request->age;
            $child->fatherName = $request->fatherName;
            $child->motherName = $request->motherName;
            $child->update();
            return redirect()->route('student.children')->with('message', 'Child Updated Successfully');
        } else {
            $time_difference = $request->student_time_difference - (-300);
            $user = User::where('email', '=', $request->email)->first();

            $random_password = null;
            if (is_null($user)) {
                request()->validate([
                    'name' => 'required|max:190|string',
                    'age' => 'required|max:190|numeric',
                    'fatherName' => 'required|max:190|string',
                ]);
                // create
                $child = new Children();
                $child->name = $request->name;
                $child->age = $request->age;
                $child->fatherName = $request->fatherName;
                $child->motherName = $request->motherName;
                $child->parent_id = Auth::id();
                $child->save();

                $parent = User::where('id', Auth::id())->first();
                $parent->is_parent = 1;
                $parent->update();

                $lastInserted_id = $child->id;

                $inquiry = new Inquiry();
                $inquiry->child_id = $lastInserted_id;
                $inquiry->student_id = Auth::id();
                $inquiry->status = 'pending';
                $inquiry->student_time_difference = $time_difference;
                $inquiry->inquiry = $request->inquiry ?? 'N/A';
                $inquiry->save();
                $parent->sendEmailVerificationNotification();

                // Inquiry::where('student_id', Auth::id())->where('child_id', null)->delete();

                return redirect()->route('student.children')->with('message', 'Child Added Successfully');
            } else {
                request()->validate([
                    'name' => 'required|max:190',
                    'email' => 'required|max:190|email',
                    'phone' => 'required|max:190',
                ]);

                $user_id = $user->id;
                $inquiry = new Inquiry();
                $inquiry->parent_id = Auth::id();
                $inquiry->student_id = $user->id;
                $inquiry->status = 'pending';
                $inquiry->student_time_difference = $time_difference;
                $inquiry->inquiry = $request->inquiry ?? 'N/A';
                $inquiry->save();
            }
            return redirect()->route('student.children')->with('message', 'Child Added Successfully');
        }
    }

    public function child_login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        // Logout the currently logged-in user
        Auth::logout();

        $secondAccountId = $request->child_id;
        // Log in the second account
        $user = User::find($secondAccountId); // Retrieve the second account user using an appropriate method
        Auth::login($user);
        return redirect()->route('student.dashboard');
    }

    public function child_profile($id)
    {
        $child = Children::where('id', base64_decode($id))->first();
        // dd($child);



        $inq_tutor = Inquiry::where('child_id', base64_decode($id))->pluck('tutor_id')->first();
        $inquiry = Inquiry::where('child_id', base64_decode($id))->first();

        if (is_null($inq_tutor)) {
            return back()->with('error', 'No tutor has been assigned yet to inquiry. Please wait');
        }

        $tutor = User::find($inq_tutor);

        $conversation_id = Conversation::where('sender_id', Auth::Id())->where('receiver_id', $inq_tutor)->pluck('id')->first();
        if (is_null($conversation_id)) {
            $conversation_id = Conversation::where('receiver_id', Auth::Id())->where('sender_id', $inq_tutor)->pluck('id')->first();
        }

        if (is_null($conversation_id)) {
            $conversation_id = Conversation::create([
                'sender_id' => Auth::Id(),
                'receiver_id' => $inq_tutor,
            ]);

            $conversation_id = $conversation_id->id;
        }


        $schedules = InquirySchedule::where('inquiry_id',$inquiry['id'])->get();

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

    public function delete(Request $request)
    {
        $child = Children::where('id', $request->id)->first();
        $inquiry = Inquiry::where('child_id', $child->id)->first();
        $subscription = Subscription::where('inquiry_id', $inquiry->id)->first();
        if ($subscription) {
            $subscription->status = 'cancelled';
            $subscription->update();
        }
        if ($inquiry) {
            $inquiry->status = 'cancelled';
            $inquiry->cancel_subs = 1;
            $inquiry->update();
        }
        $child->delete();
        return redirect()->back()->with('message', "Child is deleted successfully.");
    }

    public function multiple_subscription($child_id){
        $inquiry = Inquiry::where('child_id', base64_decode($child_id))->first();
        $id = $inquiry->id;
        return view('student.payments.payments', get_defined_vars());
    }
}
