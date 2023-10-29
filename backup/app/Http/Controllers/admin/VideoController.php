<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function list()
    {
        $videos = HomeVideo::all();

        return view('admin.videos.list', get_defined_vars());
    }

    public function add()
    {
        return view('admin.videos.add');
    }

    public function store(Request $request)
    {
        $request->validate(['url'=>'required', 'image'=>'required|mimes:jpeg,jpg,png']);
        $img = null;
        if ($request->hasFile('image')) {
            $path = 'video-images/';
            $img = uploadAvatar($request->image, $path);
        }
        HomeVideo::create(['url'=>$request->url, 'image'=>$img]);

        return redirect()->route('admin.videos')->with('message', 'Video has been added');
    }

    public function edit($id)
    {
        $video = HomeVideo::where('id', $id)->first();

        return view('admin.videos.edit', get_defined_vars());
    }

    public function update(Request $request)
    {
        $request->validate(['url'=>'required']);
        $video = HomeVideo::where('id', $request->id)->first();
        $img = $video->image;
        if ($request->hasFile('image')) {
            $path = 'video-images/';
            $img = uploadAvatar($request->image, $path);
        }
        $video->update(['url'=>$request->url, 'image'=>$img]);

        return redirect()->route('admin.videos')->with('message', 'Video has been updated');
    }

    public function delete($id)
    {
        HomeVideo::where('id', $id)->delete();

        return redirect()->route('admin.videos')->with('message', 'Video has been deleted');
    }
}
