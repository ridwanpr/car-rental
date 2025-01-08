<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\TicketMessage;
use App\Events\NewTicketMessage;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->latest()->get();
        return view('frontend.ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('frontend.ticket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $ticket = Ticket::create([
            'subject' => $request->subject,
            'user_id' => auth()->id(),
            'status' => 'open'
        ]);

        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'ticket' => $ticket->load('messages'),
                'message' => 'Ticket created successfully'
            ]);
        }

        return redirect()->route('ticket.show', $ticket->id)
            ->with('success', 'Ticket created successfully');
    }

    public function show(Ticket $ticket)
    {
        $messages = $ticket->messages()->with('user')->orderBy('created_at', 'asc')->get();

        return view('frontend.ticket.show', compact('ticket', 'messages'));
    }

    public function storeMessage(Request $request, Ticket $ticket)
    {
        if ($ticket->status === 'closed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot send messages to a closed ticket'
            ], 403);
        }

        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        $message->load('user');

        broadcast(new NewTicketMessage($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,closed'
        ]);
        $ticket->update(['status' => $request->status]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'ticket' => $ticket
            ]);
        }

        return back()->with('success', 'Ticket status updated successfully');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket deleted successfully');
    }
}
