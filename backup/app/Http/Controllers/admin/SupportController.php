<?php

namespace App\Http\Controllers\admin;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function tickets()
    {
        $open_tickets = Ticket::whereStatus('open')->get();
        $close_tickets = Ticket::whereStatus('closed')->get();

        return view('admin.tickets.enquiries', get_defined_vars());
    }

    public function detail($ticket_id)
    {
        $ticket = Ticket::whereTicketId($ticket_id)->first();

        return view('admin.tickets.enquiry_detail', get_defined_vars());
    }

    public function save_comment(Request $req)
    {
        $ticket = Ticket::find($req->ticket_id);

        $req->validate([
            'comment' => 'required',
        ]);
        $comment = new Comment();
        $comment->ticket_id = $req->ticket_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $req->comment;
        $comment->save();

        sendMail([
            'view' => 'email.user_ticket_message',
            'to' => $ticket->user->email,
            'subject' => 'New Open Ticket Notification',
            'name' => 'Live Learning',
            'data' => [
                'ticket_id' => $req->ticket_id,
                'message' => $req->comment,
            ],
        ]);

        return back()->with('message', 'Message Sent');
    }

    public function close_enquriy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = 'closed';
        $ticket->save();

        return redirect()->route('admin.support.enquiries')->with('message', 'Ticket Closed with the Ticket ID #'.$ticket->ticket_id);
    }

    public function reports()
    {
        $open_reports = Report::where('status', 'open')->get();
        $closed_reports = Report::where('status', 'closed')->get();

        return view('Admin.support.reports', get_defined_vars());
    }
}
