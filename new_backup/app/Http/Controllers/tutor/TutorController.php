<?php

namespace App\Http\Controllers\tutor;

use App\Models\Conversation;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Inquiry_Session;
use App\Models\InquirySchedule;
use App\Models\PayOut;
use App\Models\Tutor;
use App\Models\TutorReviews;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use Zoom;

class TutorController extends Controller
{
    public function tutor_info()
    {
        $user = Auth::user();

        return view('tutor.user_profile.tutor_profile')->with('user', $user);
    }

    public function session_list()
    {
        $in_session = Inquiry_Session::all();

        return view('tutor.sessions.sessions_list', compact('in_session'));
    }

    public function session_add_form($id)
    {
        $inquiry_id = $id;

        return view('tutor.sessions.sessions_add', compact('inquiry_id'));
    }

    public function inquiry_schedule(Request $request)
    {
        Inquiry::find($request->inquiry_id)->update(['duration' => $request->duration]);

        for ($i = 0; $i < count($request->days); $i++) {
            $inquirySch = new InquirySchedule();

            $inquirySch->inquiry_id = $request->inquiry_id;
            $inquirySch->tutor_id = Auth::User()->id;
            $inquirySch->day = $request->days[$i];
            $inquirySch->time = $request->time[$i];
            $inquirySch->save();
        }

        // $days_name = implode(',', $request->days);
        // $inquiry = Inquiry::find($request->inquiry_id);
        // $inquiry->session_days = $days_name;
        // $inquiry->session_start = $request->time;
        // $inquiry->save();

        return redirect()->route('tutor.appointments')->with('message', 'Your Schedule against Inquiry is Updated');
    }

    public function session_create(Request $request)
    {
        $user = Zoom::user()->find(Auth::User()->zoom_access_token);

        if (is_null($user)) {
            return response()->json(['code'=>400, 'msg' => 'You have not connected your zoom account yet.']);
        }

        if ($user->status == 'pending') {
            return response()->json(['code'=>400, 'msg' => 'Zoom invitation has not been accepted yet, please check your email and accept invitation']);
        }

        /********************************************************************/
        //MEETING CREATED
        /********************************************************************/
        $meeting = Zoom::meeting()->make([
            'userId' => Auth::Id(),
            'topic' => 'Online Class',
            'type' => 2,
            'disable_recording' => false,
            'duration' => 1,
            'timezone' => 'Pakistan',
            'password' => '1234567890',
            'agenda' => 'Teacher arrange online class for student',
        ]);
        if (! $meeting) {
            return redirect()->route('tutor.session_list')->with('message', 'There is no meeting, only zoom user can create meeting');
        } else {
            $test = $user->meetings()->save($meeting);

            $inquiry_session = Inquiry_Session::create([
                'inquiry_id' => $request->inquiry_id,
                'start_url' => $test->start_url,
                'join_url' => $test->join_url,
            ]);

            $inquiry = Inquiry::find($request->inquiry_id);

            sendMail([
                'view' => 'email.join_url',
                'to' => $inquiry->user->email,
                'name' => 'Live Learning',
                'subject' => 'Student Session Started',
                'data' => [
                    'join_url' => $test->join_url,
                ],
            ]);

            return response()->json(['code'=>200, 'msg' => $test->start_url]);
        }
        /*********************************************************************/
                        //END MEETING CREATED
        /********************************************************************/
    }

    public function single_user_session_list($id)
    {
        $inq_std = Inquiry::where('id', $id)->first();
        $std = User::find($inq_std->student_id);

        $conversation_id = Conversation::where('sender_id', Auth::Id())->where('receiver_id', $inq_std->student_id)->pluck('id')->first();
        if (is_null($conversation_id)) {
            $conversation_id = Conversation::where('receiver_id', Auth::Id())->where('sender_id', $inq_std->student_id)->pluck('id')->first();
        }

        if (is_null($conversation_id)) {
            $conversation_id = Conversation::create([
                'sender_id' => Auth::Id(),
                'receiver_id' => $inq_std->student_id,
            ]);

            $conversation_id = $conversation_id->id;
        }

        $trial_payment = true;
        if ($inq_std->is_paid == false) {
            if ($inq_std->trial_end_date != null && $inq_std->status == 'started') {
                $trial_payment = false;
            }
        }

        $schedules = InquirySchedule::where('inquiry_id', $id)->get();
        //initialize array
        $Events = [];
        $week_number = date('W');
        $year = date('Y');

        for ($day = 1; $day <= 7; $day++) {
            foreach ($schedules as $s) {
                if ($day == $s['day']) {
                    $data = date('Y-m-d', strtotime($year.'W'.$week_number.$day)).'T'.$s['time'];
                    $Events[]['start'] = $data;
                }
            }
        }

        return view('tutor.sessions.single_user_session', get_defined_vars());
    }

    public function editSchedule($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();

        return view('tutor.sessions.edit_inquiries_schedule', get_defined_vars());
    }

    public function updateScheduleList(Request $request)
    {
        Inquiry::find($request->inquiry)->update(['duration' => $request->duration]);

        $tutor_id = auth()->user()->id;
        InquirySchedule::where('inquiry_id', $request->inquiry)->delete();

        for ($i = 0; $i < count($request->day); $i++) {
            $inquirySch = new InquirySchedule();

            $inquirySch->inquiry_id = $request->inquiry;
            $inquirySch->tutor_id = $tutor_id;
            $inquirySch->day = $request->day[$i];
            $inquirySch->time = $request->time[$i];

            $inquirySch->save();
        }

        return redirect()->route('tutor.single_user_session_list', $request->inquiry)->withMessage('Schedule Updated');
    }

    public function edit_info(Request $request)
    {
        request()->validate([
            'name' => 'required|max:190',
            'email' => 'required|max:190',
            'phone' => 'required|max:190',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'address' => 'required|max:190',
        ]);
        $user = Auth::user();
        $id = Auth::id();
        // $password = DB::table('users')->where('id', $id)->value('password');

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $tutor = User::find($id)->tutor;
        $tut_address = Tutor::find($tutor->id);
        $tut_address->address = $request->address;
        $tut_address->biography = $request->biography;
        $tut_address->save();
        // logout after changing name/email
        // Auth::logout();
        return redirect()->back()->with('message', 'Credentials changed successfully,please use new credentials to SignIn');
    }

    public function reset_password(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        $password = DB::table('users')->where('id', $id)->value('password');

        $this->validate($request, [
            'oldpassword'          => 'required',
            'newpassword'              => 'required|min:8',
            'confirm_password' =>'required|same:newpassword',
        ]);
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

    public function payments()
    {
        if (Auth::user()->role == 'tutor') {
            $pay_outs = PayOut::where('tutor_id', Auth::id())->get();

            return view('tutor.payments.payments_history', get_defined_vars());
        }
    }

    public function review(Request $request)
    {
        $img = null;
        if ($request->hasFile('screenshot')) {
            $path = 'reviews/screenshot';
            $img = uploadAvatar($request->screenshot, $path);
        }
        $inq = Inquiry_Session::where('id', $request->inquiry_session_id)->first();
        $inq->update(['meeting_review'=>1]);

        TutorReviews::create([
            'tutor_id'=>$request->tutor_id,
            'student_id'=>$request->student_id,
            'screenshot'=>$img,
            'inquiry_session_id'=>$request->inquiry_session_id,
            'behavior'=>$request->behavior,
            'attention'=>$request->attention,
            'progress'=>$request->progress,
            'class_duration'=>$request->class_duration,
        ]);

        return redirect()->back()->with('success', 'Review has been added');
    }

    public function linkZooom(Request $request)
    {
        if (isset($request->flag)) {
            $user = Auth::User();
            if ($user->zoom_access_token == '') {
                $zoom_user = Zoom::user()->create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'type' => 1,
                ]);

                $user->zoom_access_token = $zoom_user->id;
                $user->save();

                return redirect()->back()->with('message', 'Your zoom account has been attached. Check your email inbox to accept invitation.');
            }
        }

        return view('tutor.zoom_account.add_zoom_account');
    }
}
