<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        if (
            $user->role !== 'admin'
            &&
            $ticket->user_id !== $user->id
        ) {
            abort(
                403,
                'Você não possui permissão para comentar neste chamado.'
            );
        }

        if (in_array($ticket->status, ['Resolvido', 'Cancelado'])) {
            return redirect()
                ->route('tickets.show', $ticket)
                ->with(
                    'error',
                    'Este chamado está encerrado e não permite novos comentários.'
                );
        }

        $validated = $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

 
        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => $validated['comment'],
            'is_read' => false,
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with(
                'success',
                'Comentário enviado com sucesso.'
            );
    }
}