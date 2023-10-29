<?php

namespace App\Http\Controllers\tutor;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $trial_month_query = Inquiry::where('tutor_id', Auth::id())->where('is_paid', false)->whereMonth('created_at', date('m'));
        $trial_month = $trial_month_query->get();
        $total_trails_in_month=$trial_month_query->count();
        
        $paid_students=0;
        foreach($trial_month as $trial_id){
            if(Subscription::where('inquiry_id', $trial_id->id)->where('status', 'active')->count()>0){
                $paid_students++;
            }
        }
        if($total_trails_in_month == 0){
            $convershion_rate = ($paid_students/1);
        }
        else{
            $convershion_rate = ($paid_students/$total_trails_in_month);
        }

        // dd($convershion_rate);

        //get student id from inquiry
        // $student_id = Inquiry::where('tutor_id', Auth::id())->pluck('student_id')->toArray();
    
        // //get student skype id from user
        // $student_skype_id = User::whereIn('id', $student_id)->pluck('skype_id')->toArray();

        // //convert array to string
        // $skype_id = implode(',', $student_skype_id);

        // // dd($skype_id);

    
        
       

        return view('tutor.appointments.appointments', get_defined_vars());
    }
}
