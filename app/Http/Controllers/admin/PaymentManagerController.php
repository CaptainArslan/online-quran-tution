<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\PaymentManager;
use App\Models\PayOut;
use App\Models\Tutor;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use PDF;

class PaymentManagerController extends Controller
{
    public function tutor_list()
    {
        $data = User::where('role', 'tutor')->get();

        return view('payment_manager.tutor.tutor_list')->with('tutor', $data);
    }

    public function pay_out($tutor_id)
    {
        $pay_outs = PayOut::where('tutor_id', $tutor_id)->get();
        $tutor = User::find($tutor_id);

        return view('payment_manager.pay-out.pay-out', get_defined_vars());
    }

    public function tutor_salary(Request $request)
    {
        $salary = Tutor::find($request->tutor_id);

        $salary->salary = $request->salary;
        $salary->save();

        return redirect()->back()->with('message', 'Salary Amount Set Successfully');
    }

    public function payment(Request $request)
    {
        if (Auth::user()->role == 'manager') {
            $manager_id = Auth::id();
        }

        $payout = new PayOut();
        $payout->tutor_id = $request->tutor_id;
        $payout->manager_id = $manager_id;
        $payout->amount_to_pay = $request->amount_to_pay * $request->hours;
        $payout->amount_paid = ($request->amount_to_pay * $request->hours) + $request->bonus;
        $payout->bonus = $request->bonus;
        $payout->manager_note = $request->note;
        $payout->status = 'paid';
        $payout->paid_at = Carbon::today()->format('Y-m-d');
        $payout->save();

        set_time_limit(300);
        $pdf_name = time().'.pdf';
        $pdf = PDF::loadView('pdf.tutor-salary', get_defined_vars())->setPaper('a4', 'landscape');

//        file_put_contents('/output/'.$pdf_name, $pdf->output());

        $user = User::where('id', $request->tutor_id)->first();
        sendMail([
            'view' => 'email.tutor-salary',
            'to' => $user->email,
            'subject' => 'Salary',
            'name' => 'Online Quran Tution ',
            'pdf' => $pdf,
            'data' => [
                'user' => $user,

            ],
        ]);

        return redirect()->back()->with('message', 'Payout Created Successfully');
    }

    // Payment_manager crud
    public function payment_manager($id = null)
    {
        $user_payment = User::find($id);
        $data = null;
        if ($id != null) {
            $manager = User::find($id)->payment_manager;

            $data = [
                'address' => $manager->address,
                'payment_manager' => $user_payment,

            ];
        }
        if (View::exists('admin.payment_manager.create')) {
            return view('admin.payment_manager.create')->with($data);
        }
    }

    public function add_payment_manager(Request $request)
    {
        request()->validate([
            'name' => 'required|max:190',
            'phone' => 'required|numeric',
            'email' => 'required|max:190',
            'address' => 'required|max:190',
            'password' => 'max:190'.($request->id ? '' : '|required'),

        ]);
        $id = $request->id;

        if ($id == 0) {
            $payment_manager = new User();
            $manager = new PaymentManager();
        } else {
            $payment_manager = User::find($id);
            $manager_table = User::find($id)->payment_manager;
            $manager = PaymentManager::find($manager_table->id);
        }
        // save to user table
        $payment_manager->name = $request->name;
        $payment_manager->email = $request->email;

        if ($request->password) {
            $payment_manager->password = Hash::make($request->password);
        }

        $payment_manager->phone = $request->phone;
        $payment_manager->role = 'manager';
        $payment_manager->save();
        $user_id = $payment_manager->id;
        // save to Payment Manager table
        $manager->user_id = $user_id;
        $manager->address = $request->address;
        $manager->save();

        if ($id == 0) {
            return redirect()->route('admin.payment_manager_list')->with('message', 'Payment Manager saved successfully');
        } else {
            return redirect()->route('admin.payment_manager_list')->with('message', 'Payment Manager updated successfully');
        }
    }

    public function payment_manager_list()
    {
        $data = User::where('role', 'manager')->orderBy('id', 'DESC')->get();
        if (View::exists('admin.payment_manager.payment_manager_list')) {
            return view('admin.payment_manager.payment_manager_list')->with('payment_managers', $data);
        }
    }

    public function remove_payment_manager($id = null)
    {
        $user_id = $id;

        // get payment_manager id from relation
        $payment_manager = User::find($user_id)->payment_manager;

        // delete payment_manager from user table
        User::destroy($user_id);

        // delete payment_manager by payment_manager id
        PaymentManager::destroy($payment_manager->id);

        return redirect()->route('admin.payment_manager_list')->with('message', 'Payment Manager removed');
    }
}
