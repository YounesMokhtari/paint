<?php

namespace App\Http\Controllers;

use App\Models\Support\Ticket;
use App\Models\Support\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('support.index', compact('tickets'));
    }

    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'department' => 'required|in:technical,educational,financial'
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'status' => 'open',
            'priority' => $validated['priority'],
            'department' => $validated['department']
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'تیکت شما با موفقیت ثبت شد.');
    }

    public function show(Ticket $ticket)
    {
//        $this->authorize('view', $ticket);

        return view('support.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $this->authorize('reply', $ticket);

        $validated = $request->validate([
            'message' => 'required|string'
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $validated['message']
        ]);

        return redirect()->back()
            ->with('success', 'پاسخ شما با موفقیت ثبت شد.');
    }
}
