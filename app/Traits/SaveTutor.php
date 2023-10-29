<?php

namespace App\Traits;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

trait SaveTutor
{
    public function add_tutor(Request $request)
    {
        request()->validate([
            'name' => 'required|max:190',
            'email' => 'required|max:190',
            'phone' => 'required|max:190',
            'password' => 'required|max:190',
            'biography' => 'required|max:190',
            'address' => 'required|max:190',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        $id = $request->id;

        if ($id == 0) {
            $user = new User();
            $tutor = new Tutor();

            $image_path = null;
        } else {
            $user = User::find($id);
            $tutor_table = User::find($id)->tutor;
            // dd($tutor_table->id);
            $tutor = Tutor::find($tutor_table->id);

            // $image_path = $user->avatar;
            // $document_path = $tutor->document;
        }

        // save image and generate path
        if ($request->hasfile('image')) {
            // unlink the previous file on edit
            if ($request->id != 0) {
                if (file_exists(public_path($image_path))) {
                    unlink(public_path($image_path));
                }
            }

            $image_path = makeImage($request->image);
        }

        // save to user table
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $image_path;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->role = 'tutor';
        $user->save();
        $user_id = $user->id;

        // save to tutor table
        $tutor->user_id = $user_id;
        $tutor->address = $request->address;

        $tutor->biography = $request->biography;
        $tutor->status = 'pending';
        $tutor->save();
    }
}
