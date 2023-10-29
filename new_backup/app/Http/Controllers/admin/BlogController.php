<?php

namespace App\Http\Controllers\admin;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function add()
    {
        return view('admin.blogs.add');
    }

    public function store(Request $req, $id = null)
    {
        // dd($req->all());
        if (is_null($id)) {
            $req->validate(['title' => 'required|min:3|max:190',
                'image' => 'required', 'description' => 'required',

            ]);
        } else {
            $req->validate(['title' => 'required|min:3|max:190',

                'description' => 'required',

            ]);
        }

        if (is_null($id)) {
            $data = $req->except('_token');
            $image_path = uploadFile($req->image, 'uploads/blogs/images', $count = null);
            $data['image'] = $image_path;
            $slug = Str::slug($data['title'], '-');
            $verify = Blog::where('slug', $slug)->count();
            if ($verify == 0) {
                $data['slug'] = $slug;
                Blog::create($data);
            } else {
                $data['slug'] = $slug.'_1';
                Blog::create($data);
            }
            $msg = 'Blog Created Successfully';
        } else {
            $data = $req->except('_token');
            if ($req->image) {
                $image_path = uploadFile($req->image, 'uploads/blogs/images', $count = null);
                $data['image'] = $image_path;
            }
            Blog::where('id', $id)->update($data);
            $msg = 'Blog Updated Successfully';
        }

        return redirect()->route('admin.blogs.list')
            ->with('message', $msg);
    }

    public function list()
    {
        $blogs = Blog::all();

        return view('admin.blogs.list', get_defined_vars());
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        return view('admin.blogs.edit', get_defined_vars());
    }

    public function delete($id)
    {
        Blog::find($id)->delete();

        return back()
            ->with('message', 'Blog deleted successfully');
    }

    public function blog_visibility($id, $visibility)
    {
        $change_visibility = Blog::find($id);
        $change_visibility->visibility = $visibility;
        $change_visibility->save();
        if ($visibility == 'hidden') {
            return back()->with('message', 'Blog Hide Successfully');
        }
        if ($visibility == 'showed') {
            return back()->with('message', 'Blog Showed Successfully');
        }
    }
}
