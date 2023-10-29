<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function logOut()
    {
        Auth::logout();

        return redirect('admin/login');
    }

    public function resetPassword(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        $password = DB::table('users')->where('id', $id)->value('password');

        $this->validate($request, [
            'oldpassword'          => 'required',
            'newpassword'              => 'required|min:8',
            'confirm_password' =>'required|same:newpassword',
        ]);
        if (Hash::check($request->oldpassword, $password)) {
            //add logic here

            $user->password = Hash::make($request->newpassword);
            $user->save();
            // logout after changing password
            return redirect('admin/login')->with('message', 'password changed successfully');
        } else {
            return redirect()->back()->with('message', 'Incorrect Old Password');
        }
    }

    public function update_Profile(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        // $password = DB::table('users')->where('id', $id)->value('password');

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect('admin/login')->with('message', 'Credentials changed successfully,please use new credentials to SignIn');
    }
}
