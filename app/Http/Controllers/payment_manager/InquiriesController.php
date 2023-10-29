<?php

namespace App\Http\Controllers\payment_manager;

use App\Exports\InSchedule;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Mail\SendMailable;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiriesController extends Controller
{
    public function show_inquiries($status = null)
    {
        if ($status == null) {
            $inquiries = Inquiry::all();
        } else {
            $inquiries = Inquiry::where('status', $status)->get();
        }

        return view('payment_manager.inquiries.show_inquiries', get_defined_vars());
    }

    public function inquiry_forward($id = null)
    {
        $inquiry = Inquiry::find($id);
        $user = $inquiry->user;
        $tutors = User::where('role', 'tutor')->get();

        return view('payment_manager.inquiries.forward_inquiry', get_defined_vars());
    }

    public function create_appointment(Request $request)
    {
        Inquiry::where('student_id', $request->student_id)
            ->update(['tutor_id' => $request->tutor_id]);
        // send mail to student on assignment of tutor
        $e_mail = User::find($request->student_id);

        $tutor_mail = User::find($request->tutor_id);
        $this->mail_student($e_mail->email);
        $this->mail_tutor($tutor_mail->email);

        return redirect()->back()->withMessage('Appointment Created');
    }

    public function inquiries_status()
    {
        $user = User::where('role', 'student')->get();
        $status_pending = Inquiry::where('status', 'pending')->get();
        $status_ontrial = Inquiry::where('status', 'on_trial')->get();
        $status_active = Inquiry::where('status', 'started')->get();
        $data = [
            'active' => $status_active,
            'on_trial' => $status_ontrial,
            'pending' => $status_pending,
            'users' => $user,
        ];

        return view('payment_manager.inquiries.inquiries_status')->with($data);
    }

    public function pending_inquiries()
    {
        $user = Inquiry::where('status', 'pending')->with('user')->get();
        $data = [

            'users' => $user,
        ];

        return view('payment_manager.inquiries.pending_inquiries')->with($data);
    }

    public function ontrial_inquiries()
    {
        $user = Inquiry::where('status', 'on_trial')->with('user')->get();
        $data = [

            'users' => $user,
        ];

        return view('payment_manager.inquiries.ontrial_inquiries')->with($data);
    }

    public function active_inquiries()
    {
        $user = Inquiry::where('status', 'started')->with('user')->get();
        $data = [
            'users' => $user,
        ];

        return view('payment_manager.inquiries.active_inquiries')->with($data);
    }

    //mail to tutor
    public function mail_student($email)
    {
        sendMail([
            'view' => 'email.tutor_assigned',
            'to' => $email,
            'subject' => 'Live Learning Tutor has been Assigned',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    //mail to student
    public function mail_tutor($email)
    {
        sendMail([
            'view' => 'email.student_attached',
            'to' => $email,
            'subject' => 'Live Learning Student Assigned',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    public function changeStatus($id, $status)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->status = $status;
        $inquiry->save();
        if ($status == 'on_trial') {
            $this->trial_email($inquiry->user->email);
        }
        if ($status == 'started') {
            $this->start_email($inquiry->user->email);
        }

        return back()->with('message', 'Inquiry status has been changed');
    }

    public function trial_email($email)
    {
        sendMail([
            'view' => 'email.test_trial',
            'to' => $email,
            'subject' => 'Live Learning Trial Test',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    public function start_email($email)
    {
        sendMail([
            'view' => 'email.start_trial',
            'to' => $email,
            'subject' => 'Live Learning Trial Started',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    public function tutorInquiries($id)
    {
        $inquiries = Inquiry::where('tutor_id', $id)->get();

        return view('payment_manager.tutor.tutor_inquiries', get_defined_vars());
    }

    public function schedule(Request $req, $id = null)
    {
        if ($id) {
            $schedules = InquirySchedule::where('tutor_id', $id);
        } else {
            $schedules = new InquirySchedule;
        }

        if ($req->filter_type) {
            if ($req->filter_type == 'daily') {
                $schedules = $schedules->whereDate('created_at', Carbon::today()->format('Y-m-d'));
            }
        }

        $tutors = Tutor::all();
        $Events = [];
        $week_number = date('W');
        $year = date('Y');

        if (isset($req->from) && isset($req->to)) {
            $schedules = $schedules->whereBetween('created_at', [$req->from, $req->to]);
        } elseif (isset($req->from) && ! isset($req->to)) {
            $schedules = $schedules->where('created_at', '>', $req->from);
        } elseif (! isset($req->from) && isset($req->to)) {
            $schedules = $schedules->where('created_at', '<', $req->to);
        }

        $schedules = $schedules->get();

        for ($day = 1; $day <= 7; $day++) {
            foreach ($schedules as $s) {
                if ($day == $s['day']) {
                    $data = date('Y-m-d', strtotime($year.'W'.$week_number.$day)).'T'.$s['time'];
                    $Events[]['start'] = $data;
                }
            }
        }
        if ($req->export) {
            return Excel::download(new InSchedule($schedules), 'inquiry_schedule.xlsx');
        }

        return view('payment_manager.inquiries.inquiry_schedule', get_defined_vars());
    }
}
