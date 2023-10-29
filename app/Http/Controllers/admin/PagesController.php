<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    // page crud
    public function page($id = null)
    {
        $page = Page::find($id);

        $data = [
            'page'=>$page,
        ];
        if (View::exists('admin.page.create')) {
            return view('admin.page.create')->with($data);
        }
    }

    public function add_page(Request $request)
    {
        request()->validate([
            'title' => 'required|max:190',
            'heading' => 'required|max:190',
            'meta_title' => 'required|max:190',
            'meta_desc' => 'required|max:190',
            'content' => 'required|max:190',

        ]);
        $id = $request->id;

        if ($id == 0) {
            $page = new Page();
        } else {
            $page = Page::find($id);
        }
        $page->title = $request->title;
        $page->heading = $request->heading;
        $page->meta_title = $request->meta_title;
        $page->meta_desc = $request->meta_desc;
        $page->description = $request->content;

        $page->save();

        if ($id == 0) {
            return redirect()->route('admin.page_list')->with('message', 'Page saved successfully');
        } else {
            return redirect()->route('admin.page_list')->with('message', 'Page updated successfully');
        }
    }

    public function page_list()
    {
        $data = Page::all();
        if (View::exists('admin.page.page')) {
            return view('admin.page.page')->with('pages', $data);
        }
    }

    public function remove_page(Request $request)
    {
        $id = $request->input('id');
        Page::destroy($id);

        return redirect()->route('admin.page_list')->with('message', 'Page removed');
    }
}
