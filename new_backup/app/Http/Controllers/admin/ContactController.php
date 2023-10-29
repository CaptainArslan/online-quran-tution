<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact_messages()
    {
        $list = Contact::all();

        return view('admin.contact.list', get_defined_vars());
    }
}
