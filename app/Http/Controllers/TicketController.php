<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with([
            'user',
            'category',
            'assignedUser'
        ])

            // Pesquisa por título
            ->when($request->search, function ($query) use ($request) {

                $query->where(
                    'title',
                    'like',
                    '%' . $request->search . '%'
                );
            })

            // Filtro por status
            ->when($request->status, function ($query) use ($request) {

                $query->where(
                    'status',
                    $request->status
                );
            })

            // Filtro por prioridade
            ->when($request->priority, function ($query) use ($request) {

                $query->where(
                    'priority',
                    $request->priority
                );
            })

            ->latest()

            ->get();

        return view(
            'tickets.index',
            compact('tickets')
        );
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
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'assigned_to' => null,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => 'Média',
            'status' => 'Aberto',
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'Chamado criado',
            'description' => 'O chamado foi aberto com status Aberto e prioridade inicial Média.',
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado aberto com sucesso! A prioridade será avaliada pela equipe responsável.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'assignedUser',
            'category',
            'comments.user',
            'histories.user',
        ]);

        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();

        $users = User::orderBy('name')
            ->get();

        return view('tickets.edit', compact('ticket', 'categories', 'users'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:Baixa,Média,Alta,Urgente',
            'status' => 'required|in:Aberto,Em andamento,Resolvido,Cancelado',
        ]);

        $oldStatus = $ticket->status;
        $oldPriority = $ticket->priority;
        $oldCategoryId = $ticket->category_id;
        $oldAssignedTo = $ticket->assigned_to;

        $ticket->update([
            'category_id' => $request->category_id,
            'assigned_to' => $request->assigned_to,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        $ticket->load(['category', 'assignedUser']);

        if ($oldStatus !== $ticket->status) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Status alterado',
                'description' => "O status foi alterado de {$oldStatus} para {$ticket->status}.",
            ]);
        }

        if ($oldPriority !== $ticket->priority) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Prioridade alterada',
                'description' => "A prioridade foi alterada de {$oldPriority} para {$ticket->priority}.",
            ]);
        }

        if ($oldCategoryId != $ticket->category_id) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Categoria alterada',
                'description' => "A categoria do chamado foi alterada para {$ticket->category->name}.",
            ]);
        }

        if ($oldAssignedTo != $ticket->assigned_to) {
            $responsavel = $ticket->assignedUser?->name ?? 'Não atribuído';

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Responsável alterado',
                'description' => "O responsável pelo chamado foi alterado para {$responsavel}.",
            ]);
        }

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Chamado atualizado com sucesso!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado excluído com sucesso!');
    }
}
