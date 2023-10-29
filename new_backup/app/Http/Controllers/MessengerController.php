<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Inquiry;
use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function messenger($id)
    {
        $user = User::find($id);
        if (! $user) {
            return redirect()->route('index');
        }

        $conversation_id = Conversation::where('sender_id', Auth::Id())->where('receiver_id', $id)->pluck('id')->first();
        if (is_null($conversation_id)) {
            $conversation_id = Conversation::where('receiver_id', Auth::Id())->where('sender_id', $id)->pluck('id')->first();
        }

        if (is_null($conversation_id)) {
            $conversation_id = Conversation::create([
                'sender_id' => Auth::Id(),
                'receiver_id' => $id,
            ]);

            $conversation_id = $conversation_id->id;
        }

        // dd(get_defined_vars());

        if (Auth::user()->role == 'student') {
            return view('student.messenger.student_messenger', get_defined_vars());
        }

        return view('tutor.messenger.tutor_messenger', get_defined_vars());
    }

    public function getChat(Request $req)
    {
        $messages = Message::where('conversation_id', $req->id)->get();
        Message::where('conversation_id', $req->id)->where('user_id', '!=', auth()->user()->id)->update([
            'is_read'=>true,
        ]);

        return view('messenger.render_messages', get_defined_vars());
    }

    public function tutorUnread(Request $request)
    {
        $toastr = false;
        $appointments = Inquiry::where('tutor_id', Auth::id())->where('status', '!=', 'cancelled')->get();
        $new = Inquiry::where('tutor_id', Auth::id())->where('is_paid', false)->get();
        $regular = Inquiry::where('tutor_id', Auth::id())->where('is_paid', true)->get();

        return view('messenger.tutor_unread_messages', get_defined_vars());
    }

    public function studentUnread(Request $request)
    {
        $toastr = false;
        $user = Auth::user();
        if($user->is_parent == 1){
            $inquiries = Inquiry::where('student_id', $user->id)->with('child')->get();
        }
        else{
            $inquiries = Inquiry::where('student_id', Auth::id())->get();
        }

        return view('messenger.student_unread_messages', get_defined_vars());
    }

    public function saveMessage(Request $req)
    {

        // dd($req->all());

        // $con = $req->convo_id;

        // if(is_null($req->convo_id))
        // {
        //     $con = Conversation::create([
        //         'sender_id' => Auth::Id(),
        //         'receiver_id' => $req->receiver_id
        //     ]);

        //     $con = $con->id;
        // }

        $m = new Message();
        $m->conversation_id = $req->con_id;
        $m->user_id = Auth::Id();
        $m->message = $req->message;
        $m->ip = $req->ip();
        $m->save();

        return response()->json('sent');
    }
}
