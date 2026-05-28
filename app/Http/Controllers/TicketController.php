<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $query = Ticket::with([
            'user',
            'category',
            'assignedUser',
        ])->withCount([
            'comments as unread_comments_count' => function ($query) use ($user) {
                $query
                    ->where('is_read', false)
                    ->where('user_id', '!=', $user->id);
            },
        ]);

        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $tickets = $query
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('priority'), function ($query) use ($request) {
                $query->where('priority', $request->priority);
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('tickets.index', compact('tickets'));
    }

    public function show(Request $request, Ticket $ticket)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $ticket->user_id !== $user->id) {
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
            ->where('user_id', '!=', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        if ($request->ajax()) {
            return response()->json([
                'comments_count' => $ticket->comments()->count(),
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
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('active', true),
            ],
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
            'user_id' => $user->id,
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'attachment' => $attachmentPath,
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'action' => 'Chamado criado',
            'description' => 'O chamado foi aberto com status Aberto e prioridade inicial Média.',
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado aberto com sucesso. A equipe de suporte poderá acompanhar sua solicitação.');
    }

    public function attend(Request $request, Ticket $ticket)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Você não possui permissão para atender chamados.');
        }

        $ticket->load([
            'user',
            'category',
            'assignedUser',
            'comments.user',
            'histories.user',
        ]);

        $ticket->comments()
            ->where('user_id', '!=', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        if ($request->ajax()) {
            return response()->json([
                'comments_count' => $ticket->comments()->count(),
            ]);
        }

        $users = User::orderBy('name')->get();

        return view('tickets.attend', compact('ticket', 'users'));
    }

    public function updateAttendance(Request $request, Ticket $ticket)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Você não possui permissão para atualizar este atendimento.');
        }

        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'priority' => [
                'required',
                Rule::in([
                    Ticket::PRIORITY_BAIXA,
                    Ticket::PRIORITY_MEDIA,
                    Ticket::PRIORITY_ALTA,
                    Ticket::PRIORITY_URGENTE,
                ]),
            ],
            'status' => [
                'required',
                Rule::in([
                    Ticket::STATUS_ABERTO,
                    Ticket::STATUS_EM_ANDAMENTO,
                    Ticket::STATUS_RESOLVIDO,
                    Ticket::STATUS_CANCELADO,
                ]),
            ],
            'comment' => 'nullable|string|max:2000',
        ]);

        if (
            !empty($validated['comment'])
            &&
            in_array($validated['status'], [
                Ticket::STATUS_RESOLVIDO,
                Ticket::STATUS_CANCELADO,
            ], true)
        ) {
            return redirect()
                ->route('tickets.attend', $ticket)
                ->with('error', 'Não é possível enviar mensagens em chamados resolvidos ou cancelados.');
        }

        $oldStatus = $ticket->status;
        $oldPriority = $ticket->priority;
        $oldAssignedTo = $ticket->assigned_to;

        $ticket->update([
            'assigned_to' => $validated['assigned_to'] ?? null,
            'priority' => $validated['priority'],
            'status' => $validated['status'],
        ]);

        if ($oldStatus !== $ticket->status) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'action' => 'Status alterado',
                'description' => "O status foi alterado de {$oldStatus} para {$ticket->status}.",
            ]);
        }

        if ($oldPriority !== $ticket->priority) {
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'action' => 'Prioridade alterada',
                'description' => "A prioridade foi alterada de {$oldPriority} para {$ticket->priority}.",
            ]);
        }

        if ($oldAssignedTo != $ticket->assigned_to) {
            $ticket->load('assignedUser');

            $responsavel = $ticket->assignedUser?->name ?? 'Não atribuído';

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'action' => 'Responsável alterado',
                'description' => "O responsável pelo chamado foi alterado para {$responsavel}.",
            ]);
        }

        if (!empty($validated['comment'])) {
            $ticket->comments()->create([
                'user_id' => $user->id,
                'comment' => $validated['comment'],
                'is_read' => false,
            ]);
        }

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Atendimento atualizado com sucesso.');
    }

    public function liveComments(Ticket $ticket)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $ticket->user_id !== $user->id) {
            abort(403, 'Você não possui permissão para acompanhar esta conversa.');
        }

        $comments = $ticket->comments()
            ->with('user')
            ->oldest()
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'ticket_id' => $comment->ticket_id,
                    'user_id' => $comment->user_id,
                    'comment' => $comment->comment,
                    'is_read' => $comment->is_read,
                    'created_at' => $comment->created_at,
                    'created_at_formatted' => $comment->created_at?->format('d/m/Y H:i'),
                    'user' => [
                        'id' => $comment->user?->id,
                        'name' => $comment->user?->name ?? 'Usuário removido',
                        'role' => $comment->user?->role ?? User::ROLE_USER,
                    ],
                ];
            });

        return response()->json([
            'count' => $comments->count(),
            'comments' => $comments,
        ]);
    }

    public function destroy(Ticket $ticket)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
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