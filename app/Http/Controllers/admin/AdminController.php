<?php

namespace App\Http\Controllers\admin;

use App\Models\Children;
use App\Models\Country;
use App\Exports\Students;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Plan;
use App\Models\Subscription;
use App\Traits\SearchModel;
use App\Models\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    use SearchModel;

    public function user_Profile()
    {
        $user = Auth::user();

        return view('admin.user_profile.user_profile', get_defined_vars());
    }

    public function plan_add_form()
    {
        $country = Country::all();

        return view('admin.plan.plan_add_form', compact('country'));
    }

    public function private_plan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'days_in_week' => 'required|Integer',
            'classes_in_month' => 'required|Integer',
            'duration' => 'required|Integer',
            'price_per_month' => 'required|Integer',
            'note' => 'required|max:150',
        ]);

        $plan = Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'days_in_week' => $request->days_in_week,
            'classes_in_month' => $request->classes_in_month,
            'duration' => $request->duration,
            'price_per_month' => $request->price_per_month,
            'note' => $request->note,
            'country_id' => $request->country_id,
            'is_private'  => $request->is_private,
        ]);
        //dd($request->all());
        return redirect()->back()->with('message', 'Private plan is created Successfully');
    }

    public function plan_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'days_in_week' => 'required|Integer',
            'classes_in_month' => 'required|Integer',
            'duration' => 'required|Integer',
            'price_per_month' => 'required|Integer',
            'note' => 'required|max:150',
        ]);
        $is_private = true;
        if ($request->is_private == null) {
            $is_private = false;
        }
        $plan = Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'days_in_week' => $request->days_in_week,
            'classes_in_month' => $request->classes_in_month,
            'duration' => $request->duration,
            'price_per_month' => $request->price_per_month,
            'note' => $request->note,
            'country_id' => $request->country_id,
            'is_private'  => $is_private,
        ]);
        //dd($request->all());
        return redirect()->route('admin.plan_list')->with('message', 'The plan is created Successfully');
    }

    public function plan_list()
    {
        $plan = Plan::all();

        return view('admin.plan.plan_list', compact('plan'));
    }

    public function plan_edit($id)
    {
        $plan = Plan::find($id);

        return view('admin.plan.plan_edit_form', compact('plan'));
    }

    public function plan_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'days_in_week' => 'required|Integer',
            'classes_in_month' => 'required|Integer',
            'duration' => 'required|Integer',
            'price_per_month' => 'required|Integer',
            'note' => 'required|max:150',
        ]);

        $is_private = true;
        if ($request->is_private == null) {
            $is_private = false;
        }
        $plan = Plan::find($id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->discount = $request->discount;
        $plan->days_in_week = $request->days_in_week;
        $plan->classes_in_month = $request->classes_in_month;
        $plan->duration = $request->duration;
        $plan->price_per_month = $request->price_per_month;
        $plan->note = $request->note;
        $plan->is_private = $is_private;
        $plan->save();

        return redirect()->route('admin.plan_list')->with('message', 'The plan is updated successfully');
    }

    public function country_list()
    {
        $country = Country::all();

        return view('admin.country.country_list', compact('country'));
    }

    public function country_add()
    {
        return view('admin.country.country_add');
    }

    public function country_store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'currency' => 'required',
        ]);
        $country = Country::create([
            'code' => $request->code,
            'name' => $request->name,
            'currency' => $request->currency,
        ]);

        return redirect()->route('admin.country_list')->with('message', 'The country is added successfully');
    }

    public function country_delete($id)
    {
        $country = Country::find($id);
        $country->delete();

        return redirect()->route('admin.country_list')->with('message', 'The country is deleted successfully');
    }

    public function country_edit($id)
    {
        $country = Country::find($id);

        return view('admin.country.country_edit', compact('country'));
    }

    public function country_update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'currency' => 'required',
        ]);
        $country = Country::find($id);
        $country->code = $request->code;
        $country->name = $request->name;
        $country->currency = $request->currency;
        $country->save();

        return redirect()->route('admin.country_list')->with('message', 'The country is updated successfully');
    }

    public function student_all(Request $request)
    {
        if ($request->ajax()) {
            $relationship_columns = ['name', 'email', 'phone', 'fathername', 'mothername', 'address'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'tutor_id', 'status'], $relationship_columns, $request->table_filter_search ?? '');

            $searchResults = $searchResults->where('student_id', '!=', null)/*->where('is_paid', true)->where('status', '!=', 'cancelled')*/;

            if ($request->export) {
                $data = $searchResults->get();

                return Excel::download(new Students($data), 'Students.xlsx');
            }
            $searchResults = $searchResults->paginate($request->table_length_limit);

            return view('admin.ajax.student_all', get_defined_vars());
        }

        return view('admin.student.student_all', get_defined_vars());
    }

    public function studen_list(Request $request)
    {
        if ($request->ajax()) {
            $relationship_columns = ['name', 'email', 'phone', 'fathername', 'mothername'];
            $relationship = 'user';
            //GO FOR SPECIFIC MODEL FOR SEARCHABLE INTERFACES to add getSearchResult() METHOD

            $searchResults = $this->SearchModel('Inquiry', $relationship, ['inquiry', 'tutor_id'], $relationship_columns, $request->table_filter_search ?? '');

            $searchResults = $searchResults->where('student_id', '!=', null)->where('is_paid', true)/*->where('status', '!=', 'cancelled')*/;

            if ($request->export) {
                $data = $searchResults->get();

                return Excel::download(new Students($data), 'Students.xlsx');
            }
            $searchResults = $searchResults->paginate($request->table_length_limit);
            return view('admin.ajax.student_list', get_defined_vars());
        }

        return view('admin.student.student_list', get_defined_vars());
    }

    public function unallocated_student(Request $request)
    {
        $inquiries = Inquiry::where('status', "pending")->where('tutor_id', null)->orderBy('created_at', 'DESC')->with('user', 'child', 'inquiry_sessions', 'plan', 'tutor', 'schedules')->get();

        return view('admin.student.unallocated_students', get_defined_vars());
    }
    public function studentScuduleEdit($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();

        $inquirySch = $inquiry->inquiry_sessions;

        return view('admin.inqueries.edit_inquiries_schedule', get_defined_vars());
    }

    public function student_delete($id)
    {
        $user = User::find($id);

        Inquiry::where('student_id', $user->id)->delete();
        Children::whereIn('parent_id', $user->id)->delete();

        $user->delete();

        return redirect()->route('admin.studen_list')->with('message', 'The student is deleted successfully');
    }

    public function add_cms()
    {
        return view('admin.cms.cms');
    }

    public function studentPayouts($id)
    {
        $student = User::find($id);

        $payouts = Subscription::where('user_id', $id)->get();
        $country = Country::all();

        return view('admin.student.payments', get_defined_vars());
    }

    public function assign_skypeID(Request $request){
        $user = Children::where('id', $request->user_id)->first();
        if($user){
            $user->skype_id = $request->skype_id;
            $user->skype_assigned_at = Carbon::now();
            $user->update();

            return redirect()->back()->with('message', 'Skype ID assign successfully');
        }
        else{
            return redirect()->back()->withErrors('User not found');
        }
    }
}
