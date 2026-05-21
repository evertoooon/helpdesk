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
                $query->where(
                    'title',
                    'like',
                    '%' . $request->search . '%'
                );
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->status
                );
            })
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


    public function show(
        Request $request,
        Ticket $ticket
    ) {
        if (
            Auth::user()->role !== 'admin'
            &&
            $ticket->user_id !== Auth::id()
        ) {
            abort(403, 'Acesso negado.');
        }

        $ticket->load([
            'user',
            'assignedUser',
            'category',
            'comments.user',
            'histories.user',
        ]);

        $ticket->comments()

            ->where(
                'user_id',
                '!=',
                Auth::id()
            )

            ->where(
                'is_read',
                false
            )

            ->update([

                'is_read' => true

            ]);

        if ($request->ajax()) {

            return response()->json([

                'comments_count' =>
                $ticket->comments->count()

            ]);
        }

        return view(
            'tickets.show',
            compact('ticket')
        );
    }


    public function create()
    {
        $categories = Category::where(
            'active',
            true
        )
            ->orderBy('name')
            ->get();

        return view(
            'tickets.create',
            compact('categories')
        );
    }


    public function store(Request $request)
    {
        $request->validate([

            'category_id' =>
            'required|exists:categories,id',

            'title' =>
            'required|string|max:255',

            'description' =>
            'required|string',

            'attachment' =>
            'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {

            $attachmentPath =
                $request
                ->file('attachment')
                ->store(
                    'ticket_attachments',
                    'public'
                );
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

            'description' =>
            'Chamado aberto com status Aberto e prioridade inicial Média.'

        ]);

        return redirect()
            ->route('tickets.index')
            ->with(
                'success',
                'Chamado aberto com sucesso.'
            );
    }


    public function attend(
        Request $request,
        Ticket $ticket
    ) {
        if (
            Auth::user()->role !== 'admin'
        ) {
            abort(
                403,
                'Acesso negado.'
            );
        }

        $ticket->load([

            'user',
            'category',
            'assignedUser',
            'comments.user',
            'histories.user'

        ]);


        $ticket->comments()

            ->where(
                'user_id',
                '!=',
                Auth::id()
            )

            ->where(
                'is_read',
                false
            )

            ->update([

                'is_read' => true

            ]);


        if ($request->ajax()) {

            return response()->json([

                'comments_count' =>
                $ticket->comments->count()

            ]);
        }

        $users =
            User::orderBy('name')
            ->get();

        return view(
            'tickets.attend',
            compact(
                'ticket',
                'users'
            )
        );
    }

    public function updateAttendance(
        Request $request,
        Ticket $ticket
    ) {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([

            'assigned_to' =>
            'nullable|exists:users,id',

            'priority' =>
            'required|in:Baixa,Média,Alta,Urgente',

            'status' =>
            'required|in:Aberto,Em andamento,Resolvido,Cancelado',

            'comment' =>
            'nullable|string'

        ]);

        $oldStatus =
            $ticket->status;

        $ticket->update([

            'assigned_to' =>
            $request->assigned_to,

            'priority' =>
            $request->priority,

            'status' =>
            $request->status

        ]);


        if (
            $oldStatus
            !=
            $ticket->status
        ) {

            TicketHistory::create([

                'ticket_id' => $ticket->id,

                'user_id' => Auth::id(),

                'action' => 'Status alterado',

                'description' =>
                "Status alterado de {$oldStatus} para {$ticket->status}"

            ]);
        }


        if (
            $request->filled('comment')
        ) {

            $ticket
                ->comments()
                ->create([

                    'user_id' =>
                    Auth::id(),

                    'comment' =>
                    $request->comment,

                    'is_read' =>
                    false

                ]);
        }

        return redirect()
            ->route(
                'tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Chamado atualizado.'
            );
    }
    public function liveComments(
        Ticket $ticket
    ) {
        if (
            Auth::user()->role !== 'admin'
            &&
            $ticket->user_id !== Auth::id()
        ) {
            abort(403, 'Acesso negado.');
        }

        $ticket->load([
            'comments.user'
        ]);

        return response()->json([

            'count' =>
            $ticket->comments->count(),

            'comments' =>
            $ticket->comments
                ->sortBy('created_at')
                ->values()

        ]);
    }

    public function destroy(
        Ticket $ticket
    ) {
        if (
            Auth::user()->role
            !==
            'admin'
        ) {
            abort(403);
        }

        if ($ticket->attachment) {

            Storage::disk(
                'public'
            )->delete(
                $ticket->attachment
            );
        }

        $ticket->delete();

        return redirect()
            ->route(
                'tickets.index'
            )
            ->with(
                'success',
                'Chamado excluído com sucesso!'
            );
    }
}
