<?php

namespace App\Http\Controllers\admin;

use App\Models\Conversation;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use App\Models\TutorReviews;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();

        return view('admin.reviews.reviews', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Review::Create([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('admin.reviews.index')->with('message', 'Review has been Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::find($id)->delete();

        return redirect()->route('admin.reviews.index')->with('message', 'Review has been deleted');
    }

    public function tutorReviews()
    {
        $reviews = TutorReviews::orderBy('created_at', 'DESC')->get();

        return view('admin.reviews.list', get_defined_vars());
    }

    public function chat(Request $request)
    {
        $conversations = Conversation::with('sender')->with('receiver')->get();

        return view('admin.chat.chat', get_defined_vars());
    }

    public function conversation($id)
    {
        $messages = Message::where('conversation_id', $id)->with('user')->orderBy('created_at', 'DESC')->get();

        return view('admin.chat.conversation', get_defined_vars());
    }
}
