<x-app-layout>

    <div class="space-y-8"
         id="ticketContainer"
         data-ticket-id="{{ $ticket->id }}"
         data-comments-count="{{ $ticket->comments->count() }}">

        <!-- Cabeçalho -->

        <div class="relative overflow-hidden rounded-[30px]
            border border-white/10
            bg-gradient-to-r
            from-[#1d3f8d]/80
            via-[#243b7a]/80
            to-[#48206f]/80
            backdrop-blur-xl p-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div class="flex items-center gap-5">

                    <div class="w-20 h-20 rounded-3xl
                        bg-blue-500/20 border border-blue-400/20
                        flex items-center justify-center text-3xl">

                        🎫

                    </div>

                    <div>

                        <h1 class="text-4xl font-bold text-white">
                            {{ $ticket->title }}
                        </h1>

                        <p class="text-blue-200 mt-2">
                            Chamado #{{ $ticket->id }}
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap gap-3">

                    <span class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-blue-100 font-semibold">
                        {{ $ticket->category->name ?? 'Sem categoria' }}
                    </span>

                    <span class="px-4 py-2 rounded-full
                        @if($ticket->status === 'Aberto') bg-blue-500/20 text-blue-100 border border-blue-300/20
                        @elseif($ticket->status === 'Em andamento') bg-yellow-500/20 text-yellow-100 border border-yellow-300/20
                        @elseif($ticket->status === 'Resolvido') bg-green-500/20 text-green-100 border border-green-300/20
                        @elseif($ticket->status === 'Cancelado') bg-red-500/20 text-red-100 border border-red-300/20
                        @else bg-white/10 text-white border border-white/10
                        @endif
                        font-semibold">

                        {{ $ticket->status }}

                    </span>

                    <span class="px-4 py-2 rounded-full
                        @if($ticket->priority === 'Baixa') bg-slate-500/20 text-slate-100 border border-slate-300/20
                        @elseif($ticket->priority === 'Média') bg-blue-500/20 text-blue-100 border border-blue-300/20
                        @elseif($ticket->priority === 'Alta') bg-orange-500/20 text-orange-100 border border-orange-300/20
                        @elseif($ticket->priority === 'Urgente') bg-red-500/20 text-red-100 border border-red-300/20
                        @else bg-white/10 text-white border border-white/10
                        @endif
                        font-semibold">

                        {{ $ticket->priority }}

                    </span>

                </div>

            </div>

        </div>

        <!-- Ações -->

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('tickets.index') }}"
               class="inline-flex items-center gap-2
               bg-white/10 hover:bg-white/20
               text-white px-5 py-3 rounded-2xl
               border border-white/10 transition">

                ← Voltar

            </a>

            @if(auth()->user()->role === 'admin')

                <a href="{{ route('tickets.attend', $ticket) }}"
                   class="inline-flex items-center gap-2
                   bg-green-600 hover:bg-green-500
                   text-white px-5 py-3 rounded-2xl
                   transition font-bold">

                    🛠 Atender chamado

                </a>

            @endif

        </div>

        <!-- Informações completas -->

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <div class="xl:col-span-2 bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">

                <h2 class="text-2xl text-white font-bold mb-6">
                    📌 Detalhes do chamado
                </h2>

                <div class="space-y-5">

                    <div>

                        <label class="text-blue-200 text-sm">
                            Título
                        </label>

                        <p class="text-white text-xl font-semibold mt-1">
                            {{ $ticket->title }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Descrição
                        </label>

                        <p class="text-white leading-7 mt-1">
                            {{ $ticket->description }}
                        </p>

                    </div>

                    @if($ticket->attachment)

                        <div>

                            <label class="text-blue-200 text-sm">
                                Imagem enviada
                            </label>

                            <a href="{{ asset('storage/'.$ticket->attachment) }}" target="_blank">

                                <img
                                    src="{{ asset('storage/'.$ticket->attachment) }}"
                                    class="mt-3 rounded-3xl max-w-md border border-white/10 shadow-lg">

                            </a>

                        </div>

                    @endif

                </div>

            </div>

            <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">

                <h2 class="text-2xl text-white font-bold mb-6">
                    🧾 Informações
                </h2>

                <div class="space-y-5">

                    <div>

                        <label class="text-blue-200 text-sm">
                            Solicitante
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->user->name ?? 'Não informado' }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Categoria
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->category->name ?? 'Sem categoria' }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Responsável
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->assignedUser->name ?? 'Não atribuído' }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Prioridade
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->priority }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Status
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->status }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Criado em
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                    <div>

                        <label class="text-blue-200 text-sm">
                            Última atualização
                        </label>

                        <p class="text-white font-semibold mt-1">
                            {{ $ticket->updated_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Histórico -->

        <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">

            <h2 class="text-2xl text-white font-bold mb-6">
                📜 Histórico do chamado
            </h2>

            <div class="space-y-4">

                @forelse($ticket->histories->sortByDesc('created_at') as $history)

                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">

                            <div>

                                <p class="text-white font-bold">
                                    {{ $history->action }}
                                </p>

                                <p class="text-blue-100 mt-1">
                                    {{ $history->description }}
                                </p>

                            </div>

                            <div class="text-sm text-blue-200 whitespace-nowrap">

                                {{ $history->created_at->format('d/m/Y H:i') }}

                            </div>

                        </div>

                        <p class="text-sm text-slate-300 mt-3">
                            Por: {{ $history->user->name ?? 'Sistema' }}
                        </p>

                    </div>

                @empty

                    <p class="text-slate-300">
                        Nenhum histórico registrado até o momento.
                    </p>

                @endforelse

            </div>

        </div>

        <!-- Chat -->

        <div class="bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border border-white/10
            p-6">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-bold text-white">
                    💬 Conversa do chamado
                </h2>

                <span class="text-xs text-blue-200 bg-white/10 border border-white/10 rounded-full px-3 py-1">
                    Atualiza automaticamente a cada 5s
                </span>

            </div>

            <div id="chatArea" class="space-y-5">

                @forelse($ticket->comments->sortBy('created_at') as $comment)

                    @php
                        $isAdmin = $comment->user->role === 'admin';
                    @endphp

                    <div class="flex {{ $isAdmin ? 'justify-end' : 'justify-start' }}">

                        <div class="
                            max-w-2xl
                            rounded-3xl
                            p-5
                            border
                            {{ $isAdmin
                                ? 'bg-green-500/20 border-green-300/20'
                                : 'bg-blue-500/20 border-blue-300/20'
                            }}">

                            <div class="flex items-center justify-between gap-6 mb-2">

                                <div>

                                    <strong class="text-white">
                                        {{ $comment->user->name }}
                                    </strong>

                                    <span class="ml-2 text-xs px-3 py-1 rounded-full
                                        {{ $isAdmin
                                            ? 'bg-green-400/20 text-green-100'
                                            : 'bg-blue-400/20 text-blue-100'
                                        }}">

                                        {{ $isAdmin ? 'Equipe de suporte' : 'Solicitante' }}

                                    </span>

                                </div>

                                <span class="text-xs text-slate-300 whitespace-nowrap">
                                    {{ $comment->created_at->format('d/m/Y H:i') }}
                                </span>

                            </div>

                            <p class="text-white leading-7">
                                {{ $comment->comment }}
                            </p>

                        </div>

                    </div>

                @empty

                    <p class="text-slate-300">
                        Nenhuma mensagem encontrada.
                    </p>

                @endforelse

            </div>

            @if(!in_array($ticket->status, ['Resolvido', 'Cancelado']))

                <form
                    method="POST"
                    action="{{ route('tickets.comments.store', $ticket) }}"
                    class="mt-8 border-t border-white/10 pt-6">

                    @csrf

                    <label class="block text-blue-100 mb-2">
                        Responder ao chamado
                    </label>

                    <textarea
                        name="comment"
                        rows="4"
                        placeholder="Digite uma resposta..."
                        class="w-full
                        bg-white/10
                        border border-white/20
                        text-white
                        rounded-2xl
                        p-4
                        placeholder-blue-200
                        focus:border-blue-300
                        focus:ring-blue-300"></textarea>

                    @error('comment')
                        <p class="text-red-300 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="flex justify-end mt-4">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-500 text-white px-7 py-4 rounded-2xl font-bold transition shadow-[0_0_20px_rgba(59,130,246,.35)]">

                            💬 Enviar resposta

                        </button>

                    </div>

                </form>

            @else

                <div class="mt-8
                    bg-yellow-500/10
                    border border-yellow-300/20
                    text-yellow-100
                    rounded-2xl
                    p-5">

                    Este chamado está <strong>{{ $ticket->status }}</strong> e não permite novas respostas.

                </div>

            @endif

        </div>

    </div>

    <script>

        const container =
            document.getElementById(
                'ticketContainer'
            );

        const ticketId =
            container.dataset.ticketId;

        let currentCount =
            parseInt(
                container.dataset.commentsCount
            );

        function playNotification() {

            try {

                const audio =
                    new Audio(
                        'https://actions.google.com/sounds/v1/alarms/notification.ogg'
                    );

                audio.play();

            } catch(e) {}

        }

        function renderComments(comments) {

            let html = '';

            comments.forEach(comment => {

                const isAdmin =
                    comment.user.role === 'admin';

                html += `

                    <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'}">

                        <div class="
                            max-w-2xl
                            rounded-3xl
                            p-5
                            border
                            ${isAdmin
                                ? 'bg-green-500/20 border-green-300/20'
                                : 'bg-blue-500/20 border-blue-300/20'}">

                            <div class="flex items-center justify-between gap-6 mb-2">

                                <div>

                                    <strong class="text-white">
                                        ${comment.user.name}
                                    </strong>

                                    <span class="ml-2 text-xs px-3 py-1 rounded-full
                                        ${isAdmin
                                            ? 'bg-green-400/20 text-green-100'
                                            : 'bg-blue-400/20 text-blue-100'}">

                                        ${isAdmin ? 'Equipe de suporte' : 'Solicitante'}

                                    </span>

                                </div>

                            </div>

                            <p class="text-white leading-7">
                                ${comment.comment}
                            </p>

                        </div>

                    </div>

                `;

            });

            document.getElementById(
                'chatArea'
            ).innerHTML = html;

        }

        function updateComments() {

            const activeElement =
                document.activeElement;

            const isTyping =
                activeElement && (
                    activeElement.tagName === 'TEXTAREA'
                    ||
                    activeElement.tagName === 'INPUT'
                    ||
                    activeElement.tagName === 'SELECT'
                );

            if (isTyping) {
                return;
            }

            fetch(
                `/tickets/${ticketId}/comments/live`
            )

            .then(
                response =>
                response.json()
            )

            .then(data => {

                if (
                    data.count >
                    currentCount
                ) {

                    currentCount =
                        data.count;

                    playNotification();

                    renderComments(
                        data.comments
                    );

                }

            });

        }

        setInterval(
            updateComments,
            5000
        );

    </script>

</x-app-layout>