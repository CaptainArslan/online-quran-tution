<?php

namespace App\Http\Controllers\student\Ticket;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::whereUserId(auth()->user()->id)->get();

        return view('student.tickets.my_tickets', get_defined_vars());
    }

    public function detail($ticket_id)
    {
        $ticket = Ticket::whereTicketId($ticket_id)->first();

        return view('student.tickets.tickets', get_defined_vars());
    }

    public function open_ticket()
    {
        return view('student.tickets.open_ticket');
    }

    public function save_ticket(Request $req)
    {
        $req->validate([
            'subject' => 'required|max:191',
            'enquiry_type' => 'required',
            'priority' => 'required',
            'description' => 'required',
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->user()->id,
            'enquiry_type' => $req->enquiry_type,
            'ticket_id' => strtoupper(Str::random(10)),
            'subject' => $req->subject,
            'priority' => $req->priority,
            'description' => $req->description,
        ]);

        sendMail([
            'view' => 'email.admin_ticket',
            'to' => 'studentemail@gmail.com',
            'subject' => 'New Open Ticket Notification',
            'name' => 'Live Learning',
            'data' => [
                'ticket_id' => $ticket->ticket_id,
            ],
        ]);

        return redirect()->route('student.ticket.tickets')->with('message', 'Ticket Open with the Ticket ID #'.$ticket->ticket_id);
    }

    public function save_comment(Request $req)
    {
        $req->validate([
            'comment' => 'required',
        ]);
        $comment = new Comment();
        $comment->ticket_id = $req->ticket_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $req->comment;
        $comment->save();

        sendMail([
            'view' => 'email.admin_ticket_message',
            'to' => 'studentemail@gmail.com',
            'subject' => 'New Open Ticket Notification',
            'name' => 'Live Learning',
            'data' => [
                'ticket_id' => $req->ticket_id,
                'message' => $req->comment,
            ],
        ]);

        return back()->with('message', 'Message Sent');
    }

    public function close_ticket($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = 'closed';
        $ticket->save();

        return redirect()->route('student.ticket.tickets')->with('message', 'Ticket Closed with the Ticket ID #'.$ticket->ticket_id);
    }
}
