<?php

namespace App\Http\Controllers\admin;

use App\Exports\AllInquiriesExport;
use App\Exports\CancelSubInquiry;
use App\Exports\InSchedule;
use App\Exports\NotPaidInquiry;
use App\Exports\PaidInquiry;
use App\Exports\TrialInquiries;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Inquiry_Session;
use App\Models\InquirySchedule;
use App\Mail\SendMailable;
use App\Mail\UpdateScheduleMail;
use App\Models\Subscription;
use App\Traits\SearchModel;
use App\Models\Tutor;
use App\Models\TutorReviews;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Excel;
use GoCardlessPro\Client;
use GoCardlessPro\Environment;
use Illuminate\Http\Request;
use App\Services\GoCardlessService;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    use SearchModel;

    protected $goCardlessService;
    public function __construct(GoCardlessService $goCardlessService)
    {
        $this->goCardlessService = $goCardlessService;
    }

    public function newTrials(Request $request)
    {
        if ($request->ajax()) {
            $relationship_columns = ['name', 'email', 'phone'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'tutor_id'], $relationship_columns, $request->table_filter_search ?? '');

            $searchResults = $searchResults->where('is_paid', false)->where('trial_end_date', null)->where('status', 'on_trial');

            $searchResults = $searchResults->paginate($request->table_length_limit);

            return view('admin.ajax.new_trials', get_defined_vars());
        }
        //  $data=Inquiry::where('is_paid',false)->where('status','on_trial')->get();
        //  $data=$data->filter(function($q){
        //      return $q->schedules()->count() > $q->inquiry_sessions()->count();
        //  });

        //->has('inquiry_sessions','>','schedules_count')->get();

        return view('admin.inqueries.new_trial', get_defined_vars());
    }

    public function regularStudents(Request $request)
    {
        if ($request->ajax()) {
            $relationship_columns = ['name', 'email', 'phone'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'tutor_id'], $relationship_columns, $request->table_filter_search ?? '');

            $searchResults = $searchResults->where('is_paid', true)->where('status', '!=', 'cancelled');

            $searchResults = $searchResults->paginate($request->table_length_limit);

            return view('admin.ajax.regular_classes', get_defined_vars());
        }

        return view('admin.inqueries.regular_students', get_defined_vars());
    }

    public function tutorsForInquiry($inquiry)
    {
        $inquiry = $inquiry;
        $tutors = User::where('role', 'tutor')->get();
        // $schedules='';

        //   $schedules=InquirySchedule::where('tutor_id',$inquiry->tutor_id)->orderBy('day','ASC')->get();
        return view('admin.inqueries.tutors_list_for_assign', get_defined_vars());
    }

    public function inquiryTutorSchedules($inquiry, $tutor_id)
    {
        $tutor = User::where('role', 'tutor')->where('id', $tutor_id)->first();
        $inquiry = Inquiry::where('id', $inquiry)->first();
        $schedules = InquirySchedule::where('tutor_id', $tutor_id)->orderBy('day', 'ASC')->get();

        return view('admin.inqueries.tutor_schedules_list_to_assign', get_defined_vars());
    }

    public function inquiryAssigned($inquiry, $tutor_id)
    {
        $inquiry_id = $inquiry;
        $inquiry = Inquiry::where('id', $inquiry_id)->first();
        $is_tutor_replace = true;

        Inquiry::where('id', $inquiry_id)
            ->update([
                'tutor_id' => $tutor_id,
                'is_tutor_replace' => $is_tutor_replace,
            ]);

        InquirySchedule::where('inquiry_id', $inquiry_id)->update([
            'tutor_id' => $tutor_id,
        ]);
        $e_mail = User::find($inquiry->user->id);
        $tutor_mail = User::find($tutor_id);

        $this->mail_student($e_mail->email);
        $this->mail_tutor($tutor_mail->email);

        return redirect()->route('admin.removed.tutors')->withMessage('Tutor has been assigned');
    }

    public function all_inquiries(Request $req, $exp = false)
    {
        if ($req->ajax()) {
            $relationship_columns = ['name', 'email', 'phone'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'tutor_id'], $relationship_columns, $req->table_filter_search ?? '');
            $searchResults = $searchResults->where('status', '!=', 'cancelled');
            if (auth()->user()->role == 'manager') {
                $searchResults = $searchResults->where('is_interested', 1)->orderBy('id', 'DESC');
            } else {
                $searchResults = $searchResults->orderBy('id', 'DESC');
            }

            if ($req->filter_type) {
                if ($req->filter_type == 'daily') {
                    $searchResults = $searchResults->where('created_at', '>=', Carbon::today());
                }
                if ($req->filter_type == 'weekly') {
                    $searchResults = $searchResults->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                if ($req->filter_type == 'monthly') {
                    $searchResults = $searchResults->whereMonth('created_at', Carbon::today()->month);
                }
                if ($req->filter_type == 'monthly') {
                    $searchResults = $searchResults->whereMonth('created_at', Carbon::today()->month);
                }
            }
            if ($req->status) {
                if ($req->status != 'All Status') {
                    $searchResults = $searchResults->where('status', $req->status);
                }
            }

            if (isset($req->from) && isset($req->to)) {
                $searchResults = $searchResults->whereBetween('created_at', [$req->from, $req->to]);
            } elseif (isset($req->from) && !isset($req->to)) {
                $searchResults = $searchResults->where('created_at', '>', $req->from);
            } elseif (!isset($req->from) && isset($req->to)) {
                $searchResults = $searchResults->where('created_at', '<', $req->to);
            }

            if (isset($req->duration)) {
                $searchResults = $searchResults->where('duration', $req->duration);
            }

                //    dd($searchResults);

            if ($req->action == 'export') {
                $searchResults = $searchResults->get();

                return Excel::download(new AllInquiriesExport($searchResults), 'all_Inquiries.xlsx');
            }

            $searchResults = $searchResults->paginate($req->table_length_limit);

            //RENDER & RETURN VIEW TO CLIENT SIDE
            return view('admin.ajax.all_inquiries', get_defined_vars());
        }

        return view('admin.inqueries.all_inquiries', get_defined_vars());
    }

    public function allInquiryExport(Request $req)
    {
        return $this->all_inquiries($req, true);
        //return Excel::download(new PaidInquiry(), 'Paid_Inquiries.xlsx');
    }

    public function paid_inquiries(Request $req, $exp = false)
    {
        if (auth()->user()->role == 'manager') {
            $data = Inquiry::where('is_interested', 1)->where('is_paid', 1);
            //  $data = Inquiry::where('is_paid', 1);
        } else {
            $data = Inquiry::where('is_paid', 1);
        }

        if ($req->filter_type) {
            if ($req->filter_type == 'daily') {
                $data->whereDate('created_at', Carbon::today()->format('Y-m-d'));
            }
            if ($req->filter_type == 'weekly') {
                $data->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if ($req->filter_type == 'monthly') {
                $data->whereMonth('created_at', Carbon::today()->month);
            }
        }

        if (isset($req->from) && isset($req->to)) {
            $data = $data->whereBetween('created_at', [$req->from, $req->to]);
        } elseif (isset($req->from) && !isset($req->to)) {
            $data = $data->where('created_at', '>', $req->from);
        } elseif (!isset($req->from) && isset($req->to)) {
            $data = $data->where('created_at', '<', $req->to);
        }
        $data = $data->get();

        if ($exp == true) {
            return Excel::download(new PaidInquiry($data), 'Paid_Inquiries.xlsx');
        }

        return view('admin.inqueries.paid_inqueries', get_defined_vars());
    }

    public function removeTutor($id)
    {
        Inquiry::where('id', $id)->update(['tutor_id' => null]);
        InquirySchedule::where('inquiry_id', $id)->update(['tutor_id' => null]);

        return redirect()->back()->with('message', 'Tutor has been removed successfully');
    }

    public function paidInquiryExport(Request $req)
    {
        return $this->paid_inquiries($req, true);
        //return Excel::download(new PaidInquiry(), 'Paid_Inquiries.xlsx');
    }

    public function not_paid_inquiries(Request $req, $exp = false)
    {
        if ($req->ajax()) {
            $relationship_columns = ['name', 'email', 'phone'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'status'], $relationship_columns, $req->table_filter_search ?? '');

            if (auth()->user()->role == 'manager') {
                $searchResults = $searchResults->where('is_interested', 1)->where('is_paid', 0)->where('status', '!=', 'cancelled')->orderBy('id', 'DESC')->where('trial_end_date', '!=', null)
                    ->where('direct_debit_start_date', null);
            } else {
                $searchResults = $searchResults->where('is_paid', 0)->where('status', '!=', 'cancelled')->orderBy('id', 'DESC')->where('trial_end_date', '!=', null)
                    ->where('direct_debit_start_date', null);
            }

            if ($req->filter_type) {
                if ($req->filter_type == 'daily') {
                    $searchResults = $searchResults->whereDate('created_at', Carbon::today());
                }
                if ($req->filter_type == 'weekly') {
                    $searchResults = $searchResults->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                if ($req->filter_type == 'monthly') {
                    $searchResults = $searchResults->whereMonth('created_at', Carbon::today()->month);
                }
            }

            if (isset($req->from) && isset($req->to)) {
                $searchResults = $searchResults->whereBetween('created_at', [$req->from, $req->to]);
            } elseif (isset($req->from) && !isset($req->to)) {
                $searchResults = $searchResults->where('created_at', '>', $req->from);
            } elseif (!isset($req->from) && isset($req->to)) {
                $searchResults = $searchResults->where('created_at', '<', $req->to);
            }
            if ($exp == true) {
                $data = $searchResults->get();

                return Excel::download(new NotPaidInquiry($data), 'Not_Paid_Inquiries.xlsx');
            }

            $searchResults = $searchResults->paginate($req->table_length_limit);

            return view('admin.ajax.not_paid', get_defined_vars());
        }
        //  $data = $data->has('inquiry_sessions')->get();

        return view('admin.inqueries.not_paid_inqueries', get_defined_vars());
    }

    public function notPaidInquiryExport(Request $req)
    {
        return $this->not_paid_inquiries($req, true);
    }

    public function inquiryFilter(Request $request)
    {

        //return $request->type;
        $students = Inquiry::where('status', $request->type)->get();

        return view('admin.inqueries.inqueries', get_defined_vars());
    }

    public function show_inquiries($status = null)
    {
        if ($status == null) {
            $inquiries = Inquiry::where('is_interested', 1)->orderBy('updated_at', 'DESC')->get();
        } else {
            $inquiries = Inquiry::where('status', $status)->where('is_interested', 1)->orderBy('updated_at', 'DESC')->get();
        }

        return view('payment_manager.inquiries.show_inquiries', get_defined_vars());
    }

    public function inquiry_forwards($id = null)
    {
        $inquiry = Inquiry::find($id);
        if ($inquiry) {
            $user = $inquiry->user;
            $tutors = User::where('role', 'tutor')->get();

            return view('payment_manager.inquiries.forward_inquiry', get_defined_vars());
        } else {
            return redirect()->back();
        }
    }

    public function changesStatus($id, $status)
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

    public function inquiry_forward($id = null)
    {
        $inquiry = Inquiry::find($id);
        if ($inquiry) {
            $user = $inquiry->user;
            $tutors = User::where('role', 'tutor')->get();

            return view('admin.inqueries.forward_inquiry', get_defined_vars());
        }
    }

    public function create_appointment(Request $request)
    {
        $inquiry = Inquiry::where('student_id', $request->student_id)->where('id', $request->inquiry_id)->first();
        $is_tutor_replace = false;
        if ($inquiry?->tutor_id !== null) {
            $is_tutor_replace = true;
        }
        Inquiry::where('id', $request->inquiry_id)
            ->update([
                'tutor_id' => $request->tutor_id,
                'is_tutor_replace' => $is_tutor_replace,
            ]);

        InquirySchedule::where('inquiry_id', $request->inquiry_id)->update([
            'tutor_id' => $request->tutor_id,
        ]);
        $e_mail = User::find($request->student_id);
        $tutor_mail = User::find($request->tutor_id);

        $this->mail_student($e_mail->email);
        $this->mail_tutor($tutor_mail->email);

        return redirect()->route('admin.inquiry.detail', [$request->inquiry_id])->withMessage('Appointment Created');
    }

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

    public function subscription_list()
    {
        $subscription = Subscription::all();

        return view('admin.subscription.list', get_defined_vars());
    }

    public function startClass($id, $status, Request $request)
    {
        $inquiry = Inquiry::find($id);
        if ($inquiry->tutor_id !== null) {
            Tutor::where('user_id', $inquiry->tutor_id)->increment('regular_inquiries');
        }

        if ($status == 'on_trial') {
            $this->trial_email($inquiry->user->email);
        }
        if ($status == 'started') {
            $this->start_email($inquiry->user->email);
        }
        if ($status == 'cancelled') {
            $this->cancel_email($inquiry->user->email);
        }
        Inquiry::find($id)->update([
            'trial_end_date' => $request->trial_end_date,
            'status' => $status,
        ]);

        return back()->with('message', 'Inquiry status has been changed');
    }

    public function directStartDate($id, Request $request)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->direct_debit_start_date = $request->direct_debit_start_date;

        $inquiry->save();

        return back()->with('message', 'Inquiry Debit Start Date Added');
    }

    public function changeStatus($id, $status)
    {
        $inquiry = Inquiry::find($id);

        if ($status == 'on_trial') {
            $this->trial_email($inquiry->user->email);
        }
        if ($status == 'started') {
            $this->start_email($inquiry->user->email);
        }
        if ($status == 'cancelled') {
            $this->cancel_email($inquiry->user->email);
        }

        $inquiry->status = $status;
        $inquiry->save();

        return back()->with('message', 'Inquiry status has been changed');
    }

    public function removeTutorFromInquiry($id)
    {
        //  $inquiry = Inquiry::find($id);
        //    Inquiry_Session::where('inquiry_id', $id)->delete();
        //    InquirySchedule::where('inquiry_id', $id)->update(['tutor_id'=>null]);
        //    $inquiry->tutor_id = NULL;
        //    $inquiry->status = 'pending';
        //    $inquiry->save();
        Inquiry::where('id', $id)->update(['tutor_id' => null]);
        InquirySchedule::where('inquiry_id', $id)->update(['tutor_id' => null]);

        return redirect()->back()->withMessage('Inquiry has been removed from tutor.');
    }

    public function destroy($id)
    {
        Inquiry::find($id)->delete();

        return back()->with('message', 'Inquiry has been deleted');
    }

    public function inquiriesPaypalPending()
    {
        $inquiries = Inquiry::where(['payment_method' => 'paypal', 'is_paid' => 0])->get();

        return view('admin.inqueries.inqueries_pending', get_defined_vars());
    }

    public function inquiriesPaypalMail(Request $request)
    {
        sendMail([
            'view' => 'email.payment_link',
            'to' => $request->email,
            'subject' => 'Live Learning Payment Link',
            'name' => 'Live Learning',
            'data' => [
                'email' => base64_encode($request->email),
                'plan_id' => base64_encode($request->plan_id),
                'inquiry_id' => base64_encode($request->inquiry_id),
            ],
        ]);

        return back()->with('message', 'Inquiry Payment Link has been sent');
    }

    public function trial_email($email)
    {
        sendMail([
            'view' => 'email.test_trial',
            'to' => $email,
            'subject' => 'Live Learning Trial is Tested',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    public function start_email($email)
    {
        sendMail([
            'view' => 'email.start_trial',
            'to' => $email,
            'subject' => 'Live Learning Trial is Started',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    public function cancel_email($email)
    {
        sendMail([
            'view' => 'email.cancel_inquiry',
            'to' => $email,
            'subject' => 'Your Inquiry has been Cancelled',
            'name' => 'Live Learning',
            'data' => [],
        ]);
    }

    public function failedPayment()
    {
        $students = Inquiry::where('is_paid', 0)->get();

        return view('admin.inqueries.failed_payment', get_defined_vars());
    }

    public function tutorInquiries($id)
    {
        $inquiries = Inquiry::where('tutor_id', $id)->get();
        $new = Inquiry::where('tutor_id', $id)->where('is_paid', false)->where('status', 'on_trial')->get();
        $regular = Inquiry::where('tutor_id', $id)->where('status', '!=', ['pending', 'on_trial'])->get();

        return view('payment_manager.tutor.tutor_inquiries', get_defined_vars());
    }

    public function cancelSubs(Request $req, $exp = false)
    {
        $students = Inquiry::where('cancel_subs', 0);

        if ($req->filter_type) {
            if ($req->filter_type == 'daily') {
                $students->whereDate('created_at', Carbon::today()->format('Y-m-d'));
            }
            if ($req->filter_type == 'weekly') {
                $students->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if ($req->filter_type == 'monthly') {
                $students->whereMonth('created_at', Carbon::today()->month);
            }
        }
        if (isset($req->from) && isset($req->to)) {
            $students = $students->whereBetween('created_at', [$req->from, $req->to]);
        } elseif (isset($req->from) && !isset($req->to)) {
            $students = $students->where('created_at', '>', $req->from);
        } elseif (!isset($req->from) && isset($req->to)) {
            $students = $students->where('created_at', '<', $req->to);
        }
        $students = $students->get();

        if ($exp == true) {
            return Excel::download(new CancelSubInquiry($students), 'Cancel_Subscription.xlsx');
        }

        return view('admin.inqueries.cancel_subs', get_defined_vars());
    }

    public function CancelSubInquiryExport(Request $req)
    {
        return $this->cancelSubs($req, true);
    }

    public function removedTutors()
    {
        if (auth()->user()->role == 'manager') {
            $new = Inquiry::where('is_interested', 1)->where('tutor_id', null)->where('status', '!=', 'cancelled')->where('status', '!=', 'pending')
                ->where('is_paid', false)->get();
            $regular = Inquiry::where('is_interested', 1)->where('tutor_id', null)->where('status', '!=', 'cancelled')->where('status', '!=', 'pending')
                ->where('is_paid', true)->get();
        } else {
            $new = Inquiry::where('tutor_id', null)->where('status', '!=', 'cancelled')->where('status', '!=', 'pending')
                ->where('is_paid', false)->get();
            $regular = Inquiry::where('tutor_id', null)->where('status', '!=', 'cancelled')->where('status', '!=', 'pending')
                ->where('is_paid', true)->get();
        }

        return view('admin.inqueries.removed_tutor', get_defined_vars());
    }

    public function trialInquiries(Request $req, $exp = false)
    {
        if ($req->ajax()) {
            $relationship_columns = ['name', 'email', 'phone'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'status'], $relationship_columns, $req->table_filter_search ?? '');

            if (auth()->user()->role == 'manager') {
                $searchResults = $searchResults->where('is_interested', 1)->where('status', '=', 'on_trial')->where('tutor_id', '!=', null);
            } else {
                $searchResults = $searchResults->where('status', '=', 'on_trial')->where('tutor_id', '!=', null);
            }

            if ($req->filter_type) {
                if ($req->filter_type == 'daily') {
                    $searchResults = $searchResults->whereDate('created_at', Carbon::today()->format('Y-m-d'));
                }
                if ($req->filter_type == 'weekly') {
                    $searchResults = $searchResults->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                if ($req->filter_type == 'monthly') {
                    $searchResults = $searchResults->whereMonth('created_at', Carbon::today()->month);
                }
            }

            if (isset($req->from) && isset($req->to)) {
                $searchResults = $searchResults->whereBetween('created_at', [$req->from, $req->to]);
            } elseif (isset($req->from) && !isset($req->to)) {
                $searchResults = $searchResults->where('created_at', '>', $req->from);
            } elseif (!isset($req->from) && isset($req->to)) {
                $searchResults = $searchResults->where('created_at', '<', $req->to);
            }

            if ($req->export) {
                $students = $searchResults->get();

                return Excel::download(new TrialInquiries($students), 'Trial_Inquiries.xlsx');
            }

            $searchResults = $searchResults->paginate($req->table_length_limit);

            return view('admin.ajax.trial', get_defined_vars());
        }

        return view('admin.inqueries.trial', get_defined_vars());
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
        } elseif (isset($req->from) && !isset($req->to)) {
            $schedules = $schedules->where('created_at', '>', $req->from);
        } elseif (!isset($req->from) && isset($req->to)) {
            $schedules = $schedules->where('created_at', '<', $req->to);
        }

        $dayOfTheWeek = Carbon::now()->dayOfWeek + 1;
        //   $final_classes= $schedules->where('day','>',$dayOfTheWeek)->get();
        //   $no_of_students=$schedules->where('day','>',$dayOfTheWeek)->get();
        $final_classes = $schedules->get();
        $sched_calendar = $schedules->get();
        $no_of_students = $schedules->get()->unique('inquiry_id');

        $schedules = $schedules->get()->unique('tutor_id')->values()->all();
        //  dd($sched_calendar);
        $c = 0;
        for ($day = 1; $day <= 7; $day++) {
            foreach ($sched_calendar as $s) {
                if ($day == $s->day) {
                    if ($s->inquiry->is_paid == true) {
                        $status = '(Regular)';
                    } else {
                        $status = '(Trial)';
                    }
                    $c++;
                    $data = date('Y-m-d', strtotime($year . 'W' . $week_number . $day)) . 'T' . $s['time'];
                    $Events[$c]['start'] = $data;
                    $Events[$c]['title'] = $status;
                }
            }
        }

        if ($req->export) {
            return Excel::download(new InSchedule($schedules), 'inquiry_schedule.xlsx');
        }

        return view('admin.inqueries.inquiry_schedule', get_defined_vars());
    }

    public function getTutorSpecificSchedulesList($id)
    {
        $schedules = InquirySchedule::where('tutor_id', $id)->get()->unique('inquiry_id');

        // $tutors = Tutor::all();
        // $Events = [];
        // $week_number = date("W");
        // $year = date("Y");

        // for ($day = 1; $day <= 7; $day++) {
        //     foreach ($schedules as $s) {
        //         if ($day == $s['day']) {
        //             $data = date('Y-m-d', strtotime($year . "W" . $week_number . $day)) . 'T' . $s['time'];
        //             $Events[]["start"] = $data;
        //         }
        //     }
        // }
        return view('admin.inqueries.tutor-specific-schedule-list', get_defined_vars());
    }

    public function editScheduleList($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();

        return view('admin.inqueries.edit_inquiries_schedule', get_defined_vars());
    }

    public function updateScheduleList(Request $request)
    {
        Inquiry::find($request->inquiry)->update(['duration' => $request->duration]);
        $inquiry = Inquiry::find($request->inquiry)->first();
        $sch = InquirySchedule::where('inquiry_id', $request->inquiry)->first();
        $tutor_id = $sch->tutor_id;
        InquirySchedule::where('inquiry_id', $request->inquiry)->delete();

        for ($i = 0; $i < count($request->day); $i++) {
            $inquirySch = new InquirySchedule();

            $inquirySch->inquiry_id = $request->inquiry;
            $inquirySch->tutor_id = $tutor_id;
            $inquirySch->day = $request->day[$i];
            $inquirySch->time = $request->time[$i];

            $inquirySch->save();
        }

        return redirect()->route('admin.inquiry.detail', $request->inquiry)->withMessage('Schedule Updated Successfully');
        //   return redirect()->route('admin.inquiry.schedule')->withMessage('Schedule Updated');
        // $inquirySch = InquirySchedule::where('id', $request->inquiry_sch_id)->first();
        // $user = $inquirySch->inquiry->user;

        // if ($inquirySch !== null) {
        //     $inquirySch->day = $request->day;
        //     $inquirySch->time = $request->time;
        //     $inquirySch->save();

        //     Mail::to($user)->send(new UpdateScheduleMail($inquirySch));
        //     return redirect()->back()->withMessage('Schedule Updated');
        // }
    }

    public function inquiryInterest($id, $status)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->is_interested = $status;

        if ($status == 0) {
            $inquiry->status = 'cancelled';
        }

        $inquiry->save();

        return redirect()->back()->withMessage('Inquiry has been updated.');
    }

    public function deleteInquiry($id)
    {
        $inquiry = Inquiry::find($id);

        InquirySchedule::where('inquiry_id', $inquiry->id)->delete();
        Inquiry_Session::where('inquiry_id', $inquiry->id)->delete();
        Subscription::where('inquiry_id', $inquiry->id)->delete();

        $inquiry->delete();

        return redirect()->back()->withMessage('Inquiry has been removed.');
    }

    public function detail($id)
    {
        $upcoming_payments = [];
        $data = [];
        $paid_payments = [];
        $inquiry = Inquiry::where('id', $id)->first();
        $tutor = $inquiry->tutor;
        $schedules = '';
        $plan = Subscription::where('inquiry_id', $id)->orderBy('created_at', 'DESC')->first();
        if ($plan != null && $plan->method == 'gocardless') {
            $client = new Client([
                'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
                'environment'  => Environment::LIVE,
            ]);
            try {
                $subscriptions = $client->subscriptions()->get($plan->subscription_id);
                $upcoming_payments = $subscriptions->api_response->body->subscriptions->upcoming_payments;
                $client = new Client([
                    'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
                    'environment'  => Environment::LIVE,
                ]);

                $response = $client->subscriptions()->get($plan->subscription_id);

                $client = new Client([
                    'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
                    'environment'  => Environment::LIVE,
                ]);
                $res = $client->payments()->list(['params' => ['customer' => $plan->customer_id]]);
                $paid_payments = $res->api_response->body->payments;

                $data = [
                    'amount' => $response->amount,
                    'start_date' => $response->start_date,
                    'currency' => $response->currency,
                    'status' => $response->status,
                    'type' => 'Gocardless',
                ];
            } catch (\Exception $e) {
            }
        }
        if ($inquiry->tutor_id !== null) {
            $schedules = InquirySchedule::where('tutor_id', $inquiry->tutor_id)->orderBy('day', 'ASC')->get();
        }
        $reviews = TutorReviews::where('student_id', $inquiry->user->id)->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F Y');
            });

        // ->whereMonth('created_at',Carbon::today()->format('m'))->whereYear('created_at',Carbon::today()->format('Y'))->get();

        return view('admin.inqueries.detail', get_defined_vars());
    }

    public function studentInquiryDetail($inquiry_id)
    {
        $inquiry = Inquiry::where('id', $inquiry_id)->first();
        $tutor = $inquiry->tutor;
        $plan = Subscription::where('inquiry_id', $inquiry_id)->orderBy('created_at', 'DESC')->first();
        $upcoming_payments = [];
        $data = [];
        if ($plan != null && $plan->method == 'gocardless') {
            $client = new Client([
                'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
                'environment'  => Environment::LIVE,
            ]);
            try {
                $subscriptions = $client->subscriptions()->get($plan->subscription_id);
                $upcoming_payments = $subscriptions->api_response->body->subscriptions->upcoming_payments;
                $client = new Client([
                    'access_token' =>   env('GOCARDLESS_ACCESS_TOKEN'),
                    'environment'  => Environment::LIVE,
                ]);

                $response = $client->subscriptions()->get($plan->subscription_id);

                $data = [
                    'amount' => $response->amount,
                    'start_date' => $response->start_date,
                    'currency' => $response->currency,
                    'status' => $response->status,
                    'type' => 'Gocardless',
                ];
            } catch (\Exception $e) {
            }
        }

        $sessions = Inquiry_Session::where('inquiry_id', $inquiry_id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $reviews = TutorReviews::where('student_id', $inquiry->user->id)->whereMonth('created_at', Carbon::today()->format('m'))->whereYear('created_at', Carbon::today()->format('Y'))->get();
        // dd($sessions);
        return view('admin.student.full_detail', get_defined_vars());
    }

    public function scheduleTrialClass($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();

        return view('payment_manager.student.set_trial', get_defined_vars());
    }

    public function setTrialClass(Request $request)
    {
        $date = Carbon::today()->format('d/m/Y');
        Inquiry::find($request->inquiry_id)->update(['duration' => $request->duration, 'status' => 'on_trial', 'trial_start' => $date]);
        $inquiry = Inquiry::where('id', $request->inquiry_id)->first();

        Tutor::where('user_id', $inquiry->tutor_id)->increment('assign_inquiries', 1);
        for ($i = 0; $i < count($request->days); $i++) {
            $inquirySch = new InquirySchedule();

            $inquirySch->inquiry_id = $request->inquiry_id;
            $inquirySch->tutor_id = $inquiry->tutor_id;
            $inquirySch->day = $request->days[$i];
            $inquirySch->time = $request->time[$i];

            $inquirySch->save();
        }

        // $days_name = implode(',', $request->days);
        // $inquiry = Inquiry::find($request->inquiry_id);
        // $inquiry->session_days = $days_name;
        // $inquiry->session_start = $request->time;
        // $inquiry->save();

        return redirect()->route('admin.inquiry.detail', $request->inquiry_id)->with('message', 'Your Schedule against Inquiry is Updated');
    }

    public function delelteBulkInquiries(Request $request)
    {
        if ($request->inquiry_id == null) {
            return redirect()->back()->with('error', 'Please Select Inquiries');
        }
        $ids = implode(',', $request->inquiry_id);
        Inquiry::whereIn('id', $request->inquiry_id)->delete();

        return redirect()->back()->with('message', 'Inquiries has been deleted');
    }

    public function sendReminder($id)
    {
        $inq_id = base64_encode($id);
        $inquiry = Inquiry::where('id', $id)->first();
        sendMail([
            'view' => 'email.student_payment_reminder',
            'to' => $inquiry->user->email,
            'subject' => 'Live Learning Payment Reminder',
            'name' => 'Live Learning',
            'data' => ['inq_id' => $inq_id],
        ]);

        return redirect()->back()->with('message', 'Payment Reminder has been sent ');
    }

    public function getGoCardless()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);

        $payments = $client->payments()->list(['params' => ['limit' => 400]]);

        //        foreach ($payments->records as $payment){
        //            if ($payment->id!=null){
        //                getCustomerName($payment->links->mandate);
        //
        //            }
        //        }
    }

    public function pendingpays()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            // 'environment'  => Environment::LIVE,
            'environment'  => env('GOCARDLESS_MODE'),
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400]]);
        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function pending_customer_approval()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'pending_customer_approval']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function pending_submission()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'pending_submission']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function submitted()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'submitted']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function confirmed()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'confirmed']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function paid_out()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'paid_out']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function cancelled()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'cancelled']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function customer_approval_denied()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'customer_approval_denied']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function failed()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'failed']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function charged_back()
    {
        $client = new Client([
            'access_token' =>  env('GOCARDLESS_ACCESS_TOKEN'),
            'environment'  => Environment::LIVE,
        ]);
        $payments = $client->payments()->list(['params' => ['limit' => 400, 'status' => 'charged_back']]);

        return view('admin.inqueries.pending_payments', get_defined_vars());
    }

    public function cancelPayment($paymentId)
    {
        $client = new Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment' => env('GOCARDLESS_MODE'),
        ]);

        try {
            $payment = $client->payments()->get($paymentId);
            // Check if the payment is cancelable
            if ($payment->status == 'pending_submission') {
                // Cancel the payment
                $cancellation = $client->payments()->cancel($paymentId);

                $subscription = Subscription::where('mandate', $payment->links->mandate)->update([
                    'status' => $cancellation->status
                ]);

                return redirect()->back()->with('message', 'Payment cancelled successfully.');
            } else {
                return redirect()->back()->with('message', 'Payment cannot be canceled.');
            }
        } catch (\Exception $e) {
            // Handle error
            return redirect()->back()->with('message', 'Failed to cancel the payment.');
        }
    }

    public function reinitiatePayment($paymentId)
    {
        $client = new Client([
            'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
            'environment' => env('GOCARDLESS_MODE'),
        ]);

        try {
            $payment = $client->payments()->get($paymentId);
            $plan = Subscription::where('mandate', $payment->links->mandate)->with('plan')->first();
            if ($payment->status == 'cancelled') {
                // Retrieve the original mandate associated with the payment
                $mandateId = $payment->links->mandate;
                // Retrieve the mandate to check its status
                $mandate = $client->mandates()->get($mandateId);

                // Check the mandate status
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
                        'status' => $subscriptions->status
                    ]);
                    return redirect()->back()->with('message', 'Payment ReInitiated successfully.');
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
