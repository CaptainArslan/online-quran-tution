<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function list()
    {
        $testimonial = Testimonial::all();

        return view('admin.testimonial.list', get_defined_vars());
    }

    public function add()
    {
        $tutor = Tutor::all();

        return view('admin.testimonial.add', get_defined_vars());
    }

    public function edit($id = null)
    {
        $tutor = Tutor::all();
        $testimonial = Testimonial::find($id);

        return view('admin.testimonial.edit', get_defined_vars());
    }

    public function status($id = null)
    {
        $testimonial = Testimonial::find($id);

        if ($testimonial->status == 1) {
            $testimonial->status = 0;
            $testimonial->save();
        } else {
            $testimonial->status = 1;
            $testimonial->save();
        }

        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial Status Changed Successfully');
    }

    public function save(Request $req, $id = null)
    {
        $req->validate([
            'name' => 'required',
            'review' => 'required',
        ]);

        if (is_null($id)) {
            Testimonial::create([
                'name' => $req->name,
                'review' => $req->review,
                'rating' => $req->rating,
                'review_date' => $req->review_date,
                'status' => 1,
            ]);
        } else {
            Testimonial::find($id)->update([
                'name' => $req->name,
                'review' => $req->review,
                'rating' => $req->rating,
                'review_date' => $req->review_date,
            ]);
        }

        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial Updated Successfully');
    }

    public function delete($id = null)
    {
        Testimonial::find($id)->delete();

        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial Deleted Successfully');
    }
}
