<?php

namespace App\Http\Controllers\admin;

use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    // coupon crud
    public function coupon($id = null)
    {
        $coupon = Coupon::find($id);

        $data = [
            'coupon'=>$coupon,
        ];
        if (View::exists('admin.coupon.create')) {
            return view('admin.coupon.create')->with($data);
        }
    }

    public function add_coupon(Request $request)
    {
        request()->validate([
            'name' => 'required|max:190',
            'code' => 'required|max:190',
            'discount_type' => 'required|max:190',
            'discount_value' => 'required|max:190',

        ]);
        $id = $request->id;

        if ($id == 0) {
            $coupon = new Coupon();
        } else {
            $coupon = Coupon::find($id);
        }
        $coupon->name = $request->name;
        $coupon->code = Str::upper($request->code);
        $coupon->discount_type = $request->discount_type;
        $coupon->discount_value = $request->discount_value;

        $coupon->save();

        if ($id == 0) {
            return redirect()->route('admin.coupon_list')->with('message', 'Coupon saved successfully');
        } else {
            return redirect()->route('admin.coupon_list')->with('message', 'Coupon updated successfully');
        }
    }

    public function coupon_list()
    {
        $data = Coupon::all();
        if (View::exists('admin.coupon.coupon_list')) {
            return view('admin.coupon.coupon_list')->with('coupons', $data);
        }
    }

    public function remove_coupon($id = null)
    {
        Coupon::destroy($id);

        return redirect()->route('admin.coupon_list')->with('message', 'Coupon removed');
    }

    public function emailCoupon(Request $request)
    {
        sendMail([
            'view' => 'email.coupon',
            'to' => $request->email,
            'subject' => 'Coupan Code for Discount on Inquiry',
            'name' => 'Live Learning',
            'data' => [
                'code' => $request->coupon_code,
            ],
        ]);

        return back()->with('message', 'Coupon Mail Sent');
    }
}
