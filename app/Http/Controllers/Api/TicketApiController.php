<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\TicketHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketApiController extends Controller
{
    public function index()
    {
        $query = Ticket::with([
            'category',
            'user',
            'assignedUser'
        ]);

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $tickets = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Chamados carregados com sucesso.',
            'data' => $tickets
        ]);
    }

    public function show(Ticket $ticket)
    {
        if (
            Auth::user()->role !== 'admin'
            &&
            $ticket->user_id !== Auth::id()
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para visualizar este chamado.'
            ], 403);
        }

        $ticket->load([
            'category',
            'user',
            'assignedUser',
            'comments.user',
            'histories.user'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chamado carregado com sucesso.',
            'data' => $ticket
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request
                ->file('attachment')
                ->store('ticket_attachments', 'public');
        }

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $attachmentPath,
            'status' => 'Aberto',
            'priority' => 'Média'
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'Chamado criado via API',
            'description' => 'Chamado aberto através da API com status Aberto e prioridade inicial Média.'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chamado criado com sucesso.',
            'data' => $ticket
        ], 201);
    }

    public function update(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para atualizar chamados.'
            ], 403);
        }

        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'priority' => 'required|in:Baixa,Média,Alta,Urgente',
            'status' => 'required|in:Aberto,Em andamento,Resolvido,Cancelado',
            'comment' => 'nullable|string|max:2000'
        ]);

        $oldStatus = $ticket->status;
        $oldPriority = $ticket->priority;
        $oldAssignedTo = $ticket->assigned_to;

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'priority' => $request->priority,
            'status' => $request->status
        ]);

        if ($oldStatus !== $ticket->status) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Status alterado via API',
                'description' => "O status foi alterado de {$oldStatus} para {$ticket->status} através da API."
            ]);
        }

        if ($oldPriority !== $ticket->priority) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Prioridade alterada via API',
                'description' => "A prioridade foi alterada de {$oldPriority} para {$ticket->priority} através da API."
            ]);
        }

        if ($oldAssignedTo != $ticket->assigned_to) {
            $ticket->load('assignedUser');

            $responsavel = $ticket->assignedUser?->name ?? 'Não atribuído';

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Responsável alterado via API',
                'description' => "O responsável pelo chamado foi alterado para {$responsavel} através da API."
            ]);
        }

        if ($request->filled('comment')) {
            if (in_array($ticket->status, ['Resolvido', 'Cancelado'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Não é possível enviar mensagens em chamados resolvidos ou cancelados.'
                ], 400);
            }

            TicketComment::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'comment' => $request->comment,
                'is_read' => false
            ]);
        }

        $ticket->load([
            'category',
            'user',
            'assignedUser',
            'comments.user',
            'histories.user'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chamado atualizado com sucesso.',
            'data' => $ticket
        ]);
    }

    public function destroy(Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para excluir chamados.'
            ], 403);
        }

        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chamado excluído com sucesso.'
        ]);
    }

    public function comment(Request $request, Ticket $ticket)
    {
        if (
            Auth::user()->role !== 'admin'
            &&
            $ticket->user_id !== Auth::id()
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para comentar neste chamado.'
            ], 403);
        }

        if (
            in_array(
                $ticket->status,
                ['Resolvido', 'Cancelado']
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Este chamado está encerrado e não permite novos comentários.'
            ], 400);
        }

        $request->validate([
            'comment' => 'required|string|max:2000'
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'is_read' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comentário enviado com sucesso.',
            'data' => $comment
        ], 201);
    }
}