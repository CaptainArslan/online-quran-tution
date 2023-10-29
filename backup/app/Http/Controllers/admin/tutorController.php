<?php

namespace App\Http\Controllers\admin;

use App\Exports\SingleTutorPayout;
use App\Exports\Tutors;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquirySchedule;
use App\Models\PayOut;
use App\Models\Tutor;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Zoom;

class tutorController extends Controller
{
    // tutor crud
    public function tutor($id = null)
    {
        $user_tutor = User::find($id);
        $tutor = null;
        $new = null;
        $regular = null;
        if ($id != null) {
            $tutor = User::find($id)->tutor;
            $tutor = Tutor::find($tutor->id);
            $new = Inquiry::where('tutor_id', $id)->where('is_paid', false)->get();
            $regular = Inquiry::where('tutor_id', $id)->where('is_paid', true)->get();
        }
        $data = [
            'tutor' => $tutor,
            'user_tutor' => $user_tutor,
            'new'=>$new,
            'regular'=>$regular,

        ];
        if (View::exists('admin.tutor.create')) {
            return view('admin.tutor.create')->with($data);
        }
    }

    public function add_tutor(Request $request)
    {
        request()->validate([
            'name' => 'required|max:190',
            'email' => 'required|max:190'.($request->id ? '' : '|unique:users'),
            'phone' => 'required|max:190',
            'password' => 'max:190'.($request->id ? '' : '|required'),
            'biography' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg'.($request->id ? '' : '|required'),
            'document' => 'mimetypes:application/pdf',
            'salary' => 'required|numeric',
            'hourly_rate' => 'required|numeric',
        ]);
        $id = $request->id;

        if ($id == 0) {
            // create

            $user = new User();
            $tutor = new Tutor();

            if (! $request->avatar) {
                $image_path = 'uploads/avatar/dummy_image.png';
            }
            if (! $request->document) {
                $document_path = null;
            }
        } else {
            $user = User::find($id);
            $tutor_table = User::find($id)->tutor;

            $tutor = Tutor::find($tutor_table->id);

            $image_path = $user->avatar;
            $document_path = $tutor->document;
        }

        // save image and generate path
        if ($request->avatar) {
            $image_path = makeImage($request->avatar);
        }
        if ($request->document) {
            $document_name = time().'-'.request()->document->getClientOriginalName();
            request()->document->move('uploads/tutor_document', $document_name);
            $document_path = 'uploads/tutor_document/'.$document_name;
        }

        // save to user table
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $image_path;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->phone = $request->phone;
        $user->role = 'tutor';
        $user->save();
        $user_id = $user->id;

        // save document and generate path
        // save to tutor table
        $tutor->user_id = $user_id;
        $tutor->address = $request->address;
        $tutor->document = $document_path;
        $tutor->salary = $request->salary;
        $tutor->hourly_rate = $request->hourly_rate;
        $tutor->biography = $request->biography;
        if (Auth::user()->role == 'admin') {
            $tutor->status = 'approved';
        } else {
            $tutor->status = 'pending';
        }

        $tutor->save();

        if (auth()->user()->role == 'manager') {
            if ($id == 0) {
                return redirect()->route('admin.shared.tutor_list')->with('message', 'Tutor saved successfully');
            } else {
                return redirect()->route('admin.shared.tutor_list')->with('message', 'Tutor updated successfully');
            }
        }

        if ($id == 0) {
            return redirect()->route('admin.tutor_list')->with('message', 'Tutor saved successfully');
        } else {
            return redirect()->route('admin.tutor_list')->with('message', 'Tutor updated successfully');
        }
    }

    public function tutor_list(Request $request)
    {
        $data = User::where('role', 'tutor');
        $data = $data->get();
        if ($request->export) {
            return Excel::download(new Tutors($data), 'Tutors.xlsx');
        }

        return view('admin.tutor.tutor', get_defined_vars());
    }

    public function remove_tutor($id = null)
    {
        $user_id = $id;

        // get tutor id from relation
        $tutor = User::find($user_id)->tutor;

        $inquiries = Inquiry::where('tutor_id', $id)->count();

        if ($inquiries > 0) {
            return back()->with('error', 'You cannot delete Teacher because he/she has assigned inquiries.');
        }

        PayOut::where('tutor_id', $user_id)->delete();
        Tutor::where('user_id', $user_id)->delete();
        User::where('id', $user_id)->delete();

        User::destroy($user_id);

        return redirect()->route('admin.tutor_list')->with('message', 'Tutor removed');
    }

    public function approvestatus($id = null)
    {
        $user = User::find($id);
        $tutor = $user->tutor;
        $tutor->status = 'approved';
        $tutor->save();

        return redirect()->route('admin.tutor_list')->with('message', 'Tutor status Approved');
    }

    public function tutorPayout(Request $request, $id)
    {
        $id = $id;
        $pay_outs = PayOut::where('tutor_id', $id);
        $user = User::find($id);
        if (isset($request->from) && isset($request->to)) {
            $pay_outs = $pay_outs->whereBetween('created_at', [$request->from, $request->to]);
        } elseif (isset($request->from) && ! isset($request->to)) {
            $pay_outs = $pay_outs->where('created_at', '>', $request->from);
        } elseif (! isset($request->from) && isset($request->to)) {
            $pay_outs = $pay_outs->where('created_at', '<', $request->to);
        }
        $pay_outs = $pay_outs->get();
        if ($request->export) {
            return Excel::download(new SingleTutorPayout($pay_outs), 'tutor_payout.xlsx');
        }

        return view('admin.tutor.payout', get_defined_vars());
    }

    public function pendingstatus($id)
    {
        $user = User::find($id);
        $tutor = $user->tutor;
        $tutor->status = 'pending';
        $tutor->save();

        return redirect()->route('admin.tutor_list')->with('message', 'Tutor status Pending');
    }

    public function tutorInquiriesSchedule(Request $request)
    {
        $inquiry_schedule = InquirySchedule::find($request->id);
        $inquiries = Inquiry::find($inquiry_schedule->inquiry_id)->first();

        return view('admin.tutor.inq_schedule_load', get_defined_vars());
    }

    public function tutorInquiries($id)
    {
        $Events = [];
        $week_number = date('W');
        $year = date('Y');
        $User = Tutor::where('user_id', $id)->first();
        $inquiries = Inquiry::where('tutor_id', $id)->get();
        $schedules = InquirySchedule::where('tutor_id', $id)->get();
        $new = Inquiry::where('tutor_id', $id)->where('is_paid', false)->get();
        $regular = Inquiry::where('tutor_id', $id)->where('is_paid', true)->get();
        $total_appintments = Inquiry::where('tutor_id', $id)->count();

        $total_students = Inquiry::where('tutor_id', $id)->distinct()->count('student_id');

        for ($day = 1; $day <= 7; $day++) {
            foreach ($schedules as $s) {
                if ($s->inquiry->is_paid == true) {
                    $status = '(Regular)';
                } else {
                    $status = '(Trial)';
                }
                if ($day == $s['day']) {
                    $data = date('Y-m-d', strtotime($year.'W'.$week_number.$day)).'T'.$s['time'];
                    $Events[] = ['start'=>$data, 'student_id'=>$s->inquiry->student_id, 'inquiry_id'=>$s->inquiry_id, 'schedules_id'=> $s->id, 'title'=>$status];
                }
            }
        }
        // dd($Events);
        return view('admin.tutor.tutor_inquiries', get_defined_vars());
    }
}
