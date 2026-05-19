<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCommentController extends Controller
{
    public function store(
        Request $request,
        Ticket $ticket
    )
    {

        $request->validate([
            'comment' => 'required|string'
        ]);

        TicketComment::create([

            'ticket_id' => $ticket->id,

            'user_id' => Auth::id(),

            'comment' => $request->comment

        ]);

        return redirect()
            ->route(
                'tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Comentário adicionado com sucesso!'
            );
    }
}