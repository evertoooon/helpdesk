<x-app-layout>

<div class="space-y-8">

    <!-- Cabeçalho -->

    <div class="relative overflow-hidden
                rounded-[30px]
                border border-white/10
                bg-gradient-to-r
                from-[#1d3f8d]/80
                via-[#243b7a]/80
                to-[#48206f]/80
                backdrop-blur-xl
                p-8">

        <div class="flex items-center gap-5">

            <div class="
                w-20 h-20
                rounded-3xl
                bg-blue-500/20
                border border-blue-400/20
                flex items-center justify-center
                shadow-[0_0_25px_rgba(59,130,246,.3)]">

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

    </div>


    <!-- Informações -->

    <div class="grid md:grid-cols-3 gap-6">

        <div class="rounded-3xl
                    bg-white/10
                    backdrop-blur-xl
                    border border-white/10
                    p-6">

            <p class="text-blue-200 text-sm">
                Categoria
            </p>

            <h2 class="text-white text-2xl font-bold mt-2">
                {{ $ticket->category->name }}
            </h2>

        </div>


        <div class="rounded-3xl
                    bg-white/10
                    backdrop-blur-xl
                    border border-white/10
                    p-6">

            <p class="text-blue-200 text-sm">
                Status
            </p>

            <h2 class="text-green-300 text-2xl font-bold mt-2">
                {{ $ticket->status }}
            </h2>

        </div>


        <div class="rounded-3xl
                    bg-white/10
                    backdrop-blur-xl
                    border border-white/10
                    p-6">

            <p class="text-blue-200 text-sm">
                Prioridade
            </p>

            <h2 class="text-yellow-300 text-2xl font-bold mt-2">
                {{ $ticket->priority }}
            </h2>

        </div>

    </div>


    <!-- Descrição -->

    <div class="
            bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border border-white/10
            p-6">

        <h2 class="text-2xl font-bold text-white mb-4">
            📝 Descrição
        </h2>

        <p class="text-blue-100 leading-8">
            {{ $ticket->description }}
        </p>

    </div>


    <!-- ANEXO -->

    @if($ticket->attachment)

    <div class="
            bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border border-white/10
            p-6">

        <h2 class="text-2xl font-bold text-white mb-5">
            📷 Anexo do problema
        </h2>

        <p class="text-blue-200 mb-4">
            Imagem enviada pelo usuário:
        </p>

        <a
            href="{{ asset('storage/'.$ticket->attachment) }}"
            target="_blank">

            <img
                src="{{ asset('storage/'.$ticket->attachment) }}"
                class="
                max-w-xl
                rounded-3xl
                border border-white/10
                shadow-[0_0_35px_rgba(59,130,246,.25)]
                hover:scale-[1.02]
                transition duration-300">

        </a>

        <p class="text-sm text-slate-400 mt-4">
            Clique na imagem para abrir em tamanho completo.
        </p>

    </div>

    @endif



    <!-- Comentários -->

    <div class="
            bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border border-white/10
            p-6">

        <h2 class="text-xl font-bold text-white mb-6">
            💬 Comentários
        </h2>

        @forelse($ticket->comments as $comment)

            <div class="
                bg-white/5
                rounded-2xl
                p-4
                mb-4">

                <div class="flex justify-between">

                    <strong class="text-white">
                        {{ $comment->user->name }}
                    </strong>

                    <span class="text-slate-400 text-sm">
                        {{ $comment->created_at->format('d/m/Y H:i') }}
                    </span>

                </div>

                <p class="text-blue-100 mt-2">
                    {{ $comment->comment }}
                </p>

            </div>

        @empty

            <p class="text-slate-300">
                Nenhum comentário encontrado.
            </p>

        @endforelse

    </div>


    <!-- Histórico -->

    <div class="
            bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border
            border-white/10
            p-6">

        <h2 class="text-xl font-bold text-white mb-6">
            📜 Histórico do chamado
        </h2>

        @forelse($ticket->histories->sortByDesc('created_at') as $history)

            <div class="flex gap-4 mb-5">

                <div class="
                w-10
                h-10
                rounded-full
                bg-blue-500/20
                flex
                items-center
                justify-center">

                    ⚡

                </div>

                <div class="
                flex-1
                bg-white/5
                rounded-2xl
                p-4">

                    <div class="flex justify-between">

                        <strong class="text-white">
                            {{ $history->action }}
                        </strong>

                        <span class="text-sm text-slate-400">
                            {{ $history->created_at->format('d/m/Y H:i') }}
                        </span>

                    </div>

                    <p class="text-blue-100 mt-2">
                        {{ $history->description }}
                    </p>

                    <small class="text-slate-400">
                        {{ $history->user?->name ?? 'Sistema' }}
                    </small>

                </div>

            </div>

        @empty

            <p class="text-slate-300">
                Nenhum histórico encontrado.
            </p>

        @endforelse

    </div>

</div>

</x-app-layout>