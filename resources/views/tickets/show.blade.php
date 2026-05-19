<x-app-layout>
    <div class="py-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-5">
            Detalhes do Chamado
        </h1>

        @if(session('success'))
            <div class="bg-green-200 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-5 rounded shadow mb-5">
            <h2 class="text-xl font-bold mb-3">
                {{ $ticket->title }}
            </h2>

            <p><strong>Categoria:</strong> {{ $ticket->category->name }}</p>
            <p><strong>Prioridade:</strong> {{ $ticket->priority }}</p>
            <p><strong>Status:</strong> {{ $ticket->status }}</p>
            <p><strong>Aberto por:</strong> {{ $ticket->user->name }}</p>

            <div class="mt-4">
                <strong>Descrição:</strong>

                <p class="mt-2">
                    {{ $ticket->description }}
                </p>
            </div>
        </div>

        <div class="bg-white p-5 rounded shadow mb-5">
            <h2 class="text-xl font-bold mb-4">
                Histórico do Chamado
            </h2>

            @if($ticket->comments->count() > 0)

                @foreach($ticket->comments as $comment)
                    <div class="border-b py-3">
                        <p class="text-sm text-gray-600">
                            <strong>{{ $comment->user->name }}</strong>
                            comentou em
                            {{ $comment->created_at->format('d/m/Y H:i') }}
                        </p>

                        <p class="mt-2">
                            {{ $comment->comment }}
                        </p>
                    </div>
                @endforeach

            @else

                <p class="text-gray-600">
                    Ainda não há comentários ou atualizações neste chamado.
                </p>

            @endif
        </div>

        <div class="bg-white p-5 rounded shadow mb-5">
            <h2 class="text-xl font-bold mb-4">
                Adicionar atualização
            </h2>

            @if ($errors->any())
                <div class="bg-red-200 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tickets.comments.store', $ticket) }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">
                        Comentário
                    </label>

                    <textarea
                        name="comment"
                        rows="4"
                        placeholder="Ex: Técnico iniciou a análise do problema."
                        class="w-full border rounded p-2">{{ old('comment') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded">
                    Salvar Comentário
                </button>
            </form>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('tickets.edit', $ticket) }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Editar
            </a>

            <a href="{{ route('tickets.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Voltar
            </a>
        </div>

    </div>
</x-app-layout>