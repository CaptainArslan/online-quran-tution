<?php

namespace App\Http\Controllers\admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function faqs()
    {
        return view('admin.faqs.add');
    }

    public function store(Request $req, $id = null)
    {
        $req->validate([
            'question' => 'required',
            'answer' => 'required',

        ]);

        if (is_null($id)) {
            $data = $req->except('_token');
            Faq::create($data);
            $msg = 'Faq Created Successfully';
        } else {
            $data = $req->except('_token');
            Faq::where('id', $id)
            ->update($data);
            $msg = 'Faq Updated Successfully';
        }

        return redirect()->route('admin.faqs.list')->with('message', $msg);
    }

    public function list()
    {
        $faqs = Faq::all();

        return view('admin.faqs.faqs_list', get_defined_vars());
    }

    public function edit($id)
    {
        $faq = Faq::find($id);

        return view('admin.faqs.edit', get_defined_vars());
    }

    public function delete($id)
    {
        Faq::find($id)->delete();

        return back()->with('message', 'Faq deleted successfully');
    }
}
