<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'manager') {
            $no_of_tutors = User::where('role', 'tutor')->count();
            $no_of_inquiries = Inquiry::count();
            $inquiries = Inquiry::orderBy('updated_at', 'desc')->take(100)->get();
            $pendinginquiries = Inquiry::where('status', 'pending')->count();
            $done_inquiries = Inquiry::where('status', 'started')->count();

            return view('admin.dashboard.dashboard_2', get_defined_vars());
        }
        $no_of_tutors = User::where('role', 'tutor')->count();
        $no_of_inquiries = Inquiry::count();
        $inquiries = Inquiry::orderBy('updated_at', 'DESC')->take(30)->get();

        $inq_paid = Inquiry::where('is_paid', 1)->get();
        $inq_not_paid = Inquiry::where('is_paid', 0)->get();

        $inq_pending = Inquiry::where('status', 'pending')->get();
        $inq_started = Inquiry::where('status', 'started')->get();
        $inq_not_started = Inquiry::where('status', 'not_start')->get();
        $inq_on_trial = Inquiry::where('is_paid', false)->where('status', 'on_trial')->whereHas('user', function ($q) {
            $q->where('email_verified_at', '!=', null);
        })->get();
        $inq_cancelled = Inquiry::where('status', 'cancelled')->get();

        $all_expense = Expense::all()->sum('amount');
        $all_revenue = Subscription::all()->sum('amount');

        $daily_sales = Subscription::whereDate('created_at', '=', Carbon::today())->sum('amount');
        $daily_sales_count = Subscription::whereDate('created_at', '=', Carbon::today())->count();

        $monthly_sales = Subscription::whereDate('created_at', '<=', Carbon::today())->whereDate('created_at', '>=', Carbon::today()->subDays(30))->sum('amount');
        $monthly_sales_count = Subscription::whereDate('created_at', '<=', Carbon::today())->whereDate('created_at', '>=', Carbon::today()->subDays(30))->count();

        $weekly_sales = Subscription::where('status', 1)->where('created_at', '>=', Carbon::today()->subDays(7))->get();
        $weekly_expense = Expense::where('created_at', '>=', Carbon::today()->subDays(7))->sum('amount');

        return view('admin.dashboard.dashboard_1', get_defined_vars());
    }

    public function inquiries(Request $request)
    {
        if ($request->q == 'total') {
            $inquiries = Inquiry::orderBy('created_at', 'DESC')->get();
        } else {
            $inquiries = Inquiry::where('status', $request->q)->orderBy('created_at', 'DESC')->get();
        }

        return view('admin.inqueries.dashboard_inquiries', get_defined_vars());
    }

    public function inquiriesStatus(Request $request)
    {
        dd('status');
    }
}
