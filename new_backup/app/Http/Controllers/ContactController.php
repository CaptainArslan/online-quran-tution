<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function contact_submit(Request $req)
    {
        request()->validate([
            'name' => 'required|max:190',
            'email' => 'required|max:190|unique:contacts,email|email',
            'subject' => 'required|max:190',
            'message' => 'required',
        ]);

        Contact::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'subject'=>$req->subject,
            'message'=>$req->message,
        ]);

        return back()->with('success', 'Submitted successfully');
    }
}
