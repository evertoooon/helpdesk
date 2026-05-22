<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with([
            'user',
            'category',
            'assignedUser'
        ])->withCount([
            'comments as unread_comments_count' => function ($query) {
                $query
                    ->where('is_read', false)
                    ->where('user_id', '!=', Auth::id());
            }
        ]);

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $tickets = $query
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->priority, function ($query) use ($request) {
                $query->where('priority', $request->priority);
            })
            ->latest()
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    public function show(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin' && $ticket->user_id !== Auth::id()) {
            abort(403, 'Você não possui permissão para visualizar este chamado.');
        }

        $ticket->load([
            'user',
            'assignedUser',
            'category',
            'comments.user',
            'histories.user',
        ]);

        $ticket->comments()
            ->where('user_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        if ($request->ajax()) {
            return response()->json([
                'comments_count' => $ticket->comments->count()
            ]);
        }

        return view('tickets.show', compact('ticket'));
    }

    public function create()
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();

        return view('tickets.create', compact('categories'));
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
            'action' => 'Chamado criado',
            'description' => 'O chamado foi aberto com status Aberto e prioridade inicial Média.'
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado aberto com sucesso. A equipe de suporte poderá acompanhar sua solicitação.');
    }

    public function attend(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Você não possui permissão para atender chamados.');
        }

        $ticket->load([
            'user',
            'category',
            'assignedUser',
            'comments.user',
            'histories.user'
        ]);

        $ticket->comments()
            ->where('user_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        if ($request->ajax()) {
            return response()->json([
                'comments_count' => $ticket->comments->count()
            ]);
        }

        $users = User::orderBy('name')->get();

        return view('tickets.attend', compact('ticket', 'users'));
    }

    public function updateAttendance(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Você não possui permissão para atualizar este atendimento.');
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
                'action' => 'Status alterado',
                'description' => "O status foi alterado de {$oldStatus} para {$ticket->status}."
            ]);
        }

        if ($oldPriority !== $ticket->priority) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Prioridade alterada',
                'description' => "A prioridade foi alterada de {$oldPriority} para {$ticket->priority}."
            ]);
        }

        if ($oldAssignedTo != $ticket->assigned_to) {
            $ticket->load('assignedUser');

            $responsavel = $ticket->assignedUser?->name ?? 'Não atribuído';

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Responsável alterado',
                'description' => "O responsável pelo chamado foi alterado para {$responsavel}."
            ]);
        }

        if ($request->filled('comment')) {
            if (in_array($ticket->status, ['Resolvido', 'Cancelado'])) {
                return redirect()
                    ->route('tickets.show', $ticket)
                    ->with('error', 'Não é possível enviar mensagens em chamados resolvidos ou cancelados.');
            }

            $ticket->comments()->create([
                'user_id' => Auth::id(),
                'comment' => $request->comment,
                'is_read' => false
            ]);
        }

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Atendimento atualizado com sucesso.');
    }

    public function liveComments(Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin' && $ticket->user_id !== Auth::id()) {
            abort(403, 'Você não possui permissão para acompanhar esta conversa.');
        }

        $ticket->load([
            'comments.user'
        ]);

        return response()->json([
            'count' => $ticket->comments->count(),
            'comments' => $ticket->comments
                ->sortBy('created_at')
                ->values()
        ]);
    }

    public function destroy(Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Você não possui permissão para excluir chamados.');
        }

        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado excluído com sucesso.');
    }
}