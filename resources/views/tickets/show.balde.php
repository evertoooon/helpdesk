<x-app-layout>
    <div class="py-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-5">
            Detalhes do Chamado
        </h1>

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