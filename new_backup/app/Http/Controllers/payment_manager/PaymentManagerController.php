<?php

namespace App\Http\Controllers\payment_manager;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\PaymentManager;
use App\Models\PayOut;
use App\Models\Subscription;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaymentManagerController extends Controller
{
    public function dashboard()
    {
        $no_of_tutors = User::where('role', 'tutor')->count();
        $no_of_inquiries = Inquiry::count();
        $inquiries = Inquiry::orderBy('id', 'desc')->take(10)->get();
        $pendinginquiries = Inquiry::where('status', 'pending')->count();
        $done_inquiries = Inquiry::where('status', 'started')->count();

        return view('admin.dashboard.dashboard_2', get_defined_vars());
    }

    public function tutor_list()
    {
        $data = User::where('role', 'tutor')->get();

        return view('payment_manager.tutor.tutor_list')->with('tutor', $data);
    }

    public function student_list()
    {
        $data = User::where('role', 'student')->get();

        return view('payment_manager.student.student_list')->with('tutor', $data);
    }

    public function start_trial($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->status = 'on_trial';
        $inquiry->save();

        return redirect()->back()->with('message', 'The Status is Changed');
    }

    public function cancel($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->status = 'cancelled';
        $inquiry->tutor_id = '';
        $inquiry->save();

        return redirect()->back()->with('message', 'The Status is changed');
    }

    public function pending($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->status = 'pending';
        $inquiry->save();

        return redirect()->back()->with('message', 'The Status is changed');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('payment_manager.profile.profile', get_defined_vars());
    }

    public function edit_profile(Request $request)
    {
        request()->validate([
            'name' => 'required|max:190',
            'email' => 'required|max:190',
            'phone' => 'required|max:190',

            'address' => 'required|max:190',
        ]);
        $user = Auth::user();
        $id = Auth::id();

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $manager = User::find($id)->payment_manager;
        $manager_address = PaymentManager::find($manager->id);
        $manager_address->address = $request->address;

        $manager_address->save();
        // logout after changing name/email
        Auth::logout();

        return redirect('/login')->with('message', 'Credentials changed successfully,please use new credentials to SignIn');
    }

    public function reset_password(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        $password = DB::table('users')->where('id', $id)->value('password');

        $this->validate($request, [
            'oldpassword'          => 'required',
            'newpassword'              => 'required|min:8',
            'confirm_password' => 'required|same:newpassword',
        ]);
        if (Hash::check($request->oldpassword, $password)) {
            //add logic here

            $user->password = Hash::make($request->newpassword);
            $user->save();
            // logout after changing password
            Auth::logout();

            return redirect('admin/login')->with('message', 'password changed successfully');
        } else {
            return redirect()->back()->with('message', 'Incorrect Old Password');
        }
    }

    public function edit_pic(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $id = Auth::id();
        $image_path = uploadFile($request->image, 'uploads/manager_profile_picture');
        $user = User::find($id);
        $user->avatar = $image_path;
        $user->save();

        return redirect()->back();
    }

    public function tutor_salary(Request $request)
    {
        $salary = Tutor::find($request->tutor_id);

        $salary->salary = $request->salary;
        $salary->save();

        return redirect()->back()->with('message', 'Salary Amount Set Successfully');
    }

    public function pay_out($tutor_id)
    {
        $pay_outs = PayOut::all();

        return view('payment_manager.pay-out.pay-out', get_defined_vars());
    }

    public function payment(Request $request)
    {
        if (Auth::user()->role == 'manager') {
            $manager_id = Auth::id();
        }

        $payout = new PayOut();
        $payout->tutor_id = $request->tutor_id;
        $payout->manager_id = $manager_id;
        $payout->amount_to_pay = $request->amount_to_pay;
        $payout->bonus = $request->bonus;
        $payout->manager_note = $request->note;
        $payout->status = 'pending';
        $payout->save();

        return redirect()->back()->with('message', 'Payout Created Successfully');
    }

    public function subcription_list()
    {
        $subscription = Subscription::all();

        return view('payment_manager.subscription.list', get_defined_vars());
    }
}
