<?php

namespace App\Console;

use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Models\TutorReviews;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $today_num = Carbon::now()->dayOfWeek;
            if ($today_num == 0) {
                $today_num = 7;
            }

            $schedules = InquirySchedule::where('day', $today_num)->where('email_notify', false)->get();

            foreach ($schedules as $schedule) {
                $time = Carbon::parse($schedule->time)->format('H:i:s');
                $utc_time = Carbon::now()->addMinutes(300)->format('H:i:s');
                $difference = Carbon::parse($time)->diffInMinutes(Carbon::parse($utc_time));

                if ($difference <= 60) {
                    $inqu = $schedule->inquiry;
                    if ($inqu->is_paid == false) {
                        if ($inqu->schedules()->count() <= $inqu->inquiry_sessions()->count()) {
//                            continue;
                        }
                    }

                    $schedule->update(['email_notify'=>true]);
                    if ($schedule->inquiry->user == null) {
                    } else {
                        $schedule->update(['email_notify'=>true]);
                        sendMail([
                            'view' => 'email.schedule_cron_email',
                            'to' => $schedule->inquiry->tutor->email,
                            'subject' => 'CLass Time Alert',
                            'name' =>  $schedule->inquiry->tutor->name,
                            'data' => [
                                'user' => $schedule->inquiry->tutor,

                            ],
                        ]);

                        sendMail([
                            'view' => 'email.schedule_cron_email',
                            'to' => $schedule->inquiry->user->email,
                            'subject' => 'CLass Time Alert',
                            'name' =>  $schedule->inquiry->user->name,
                            'data' => [
                                'user' => $schedule->inquiry->user,

                            ],
                        ]);
                    }
                }
            }
        })->everyTenMinutes();

        $schedule->call(function () {
            $inquiries = InquirySchedule::all();

            foreach ($inquiries as $inquiry) {
                $inquiry->update(['email_notify'=>false]);
            }
        })->dailyAt('01:00');

        $schedule->call(function () {
            $tutors = User::where('role', 'tutor')->where('review_notification', false)->get();
            $students = User::where('role', 'student')->where('review_notification', false)->get();

            foreach ($tutors as $tutor) {
                $reviews = TutorReviews::where('tutor_id', $tutor->id)->whereMonth('created_at', Carbon::now()->format('m'))->whereYear('created_at', Carbon::now()->format('Y'))->get();

                if (count($reviews) > 0) {
                    sendMail([
                        'view' => 'email.tutor_monthly_report',
                        'to' => $tutor->email,
                        'subject' => 'Live Learning Monthly Reviews Report',
                        'name' =>  $tutor->name,
                        'data' => [
                            'reviews' => $reviews, 'student_ids'=>$reviews->unique('student_id')->pluck('student_id'),

                        ],
                    ]);
                    $tutor->update([
                        'review_notification'=>true,
                    ]);
                }
            }

            foreach ($students as $student) {
                $reviews = TutorReviews::where('student_id', $student->id)->whereMonth('created_at', Carbon::now()->format('m'))->whereYear('created_at', Carbon::now()->format('Y'))->get();
                if (count($reviews) > 0) {
                    sendMail([
                        'view' => 'email.student_monthly_report',
                        'to' => $student->email,
                        'subject' => 'Live Learning Monthly Reviews Report',
                        'name' =>  $student->name,
                        'data' => [
                            'reviews' => $reviews, 'tutor_ids'=>$reviews->unique('tutor_id')->pluck('tutor_id'),
                        ],
                    ]);
                    $student->update([
                        'review_notification'=>true,
                    ]);
                }
            }
        })->monthlyOn(1, '01:00');

        $schedule->call(function () {
            $users = User::all();

            foreach ($users as $user) {
                $inquiry->update(['review_notification'=>false]);
            }
        })->monthlyOn(2, '01:00');

        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
