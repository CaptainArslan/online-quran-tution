<?php

namespace App\Http\Controllers\tutor;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function appointments()
    {
        $session_zoom = '0';
        $session_rec = \App\Models\Inquiry_Session::whereDate('created_at', \Carbon\Carbon::today())->where('meeting_review', false)->get();
        foreach ($session_rec as $recorded) {
            if ($recorded->inquiry->tutor_id == auth()->user()->id) {
                $tutor = $recorded->inquiry->tutor->id;
                $student = $recorded->inquiry->user;
                $session = $recorded->id;
                $session_zoom = '1';
                $recorded->update(['meeting_review'=>true]);
                break;
            }
        }
        $appointments = Inquiry::where('tutor_id', Auth::id())->where('status', '!=', 'cancelled')->get();
        $new = Inquiry::where('tutor_id', Auth::id())->where('is_paid', false)->get();
        $regular = Inquiry::where('tutor_id', Auth::id())->where('is_paid', true)->get();
        $data = [
            'appointments' => $appointments,
        ];
        //dd($data);

        $total_appintments = Inquiry::where('tutor_id', Auth::id())->count();

        $total_students = Inquiry::where('tutor_id', Auth::id())->distinct()->count('student_id');

        $schedules = InquirySchedule::where('tutor_id', Auth::id())->get();

        //initialize array
        $Events = [];
        $week_number = date('W');
        $year = date('Y');

        $c = 0;
        for ($day = 1; $day <= 7; $day++) {
            foreach ($schedules as $s) {
                if ($s->inquiry->is_paid == true) {
                    $status = '(Regular)';
                } else {
                    $status = '(Trial)';
                }

                if ($day == $s['day']) {
                    $c++;
                    $data = date('Y-m-d', strtotime($year.'W'.$week_number.$day)).'T'.$s['time'];
                    $Events[$c - 1]['title'] = $status;
                    $Events[$c - 1]['start'] = $data;
                }
            }
        }

        return view('tutor.appointments.appointments', get_defined_vars());
    }
}
