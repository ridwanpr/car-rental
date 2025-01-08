<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\TicketMessage;
use App\Events\NewTicketMessage;
use App\Http\Controllers\Controller;

class TicketRequestController extends Controller
{
    public function index()
    {
        $tickets = Ticket::get();
        return view('backend.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $messages = $ticket->messages()->with('user')->orderBy('created_at', 'asc')->get();

        return view('backend.ticket.show', compact('ticket', 'messages'));
    }

    public function storeMessage(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        if ($ticket->status === 'closed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot send messages to a closed ticket'
            ], 403);
        }

        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->user()->id,
            'message' => $request->message
        ]);

        $message->load('user');

        broadcast(new NewTicketMessage($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
