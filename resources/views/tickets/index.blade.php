<x-app-layout>
    <div class="py-6 max-w-7xl mx-auto">

        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-bold">Chamados</h1>

            <a href="{{ route('tickets.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Novo Chamado
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-200 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Título</th>
                    <th class="p-2">Categoria</th>
                    <th class="p-2">Prioridade</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Usuário</th>
                    <th class="p-2">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tickets as $ticket)
                    <tr class="border">
                        <td class="p-2">{{ $ticket->title }}</td>
                        <td class="p-2">{{ $ticket->category->name }}</td>
                        <td class="p-2">{{ $ticket->priority }}</td>
                        <td class="p-2">{{ $ticket->status }}</td>
                        <td class="p-2">{{ $ticket->user->name }}</td>

                        <td class="p-2 flex gap-2">
                            <a href="{{ route('tickets.show', $ticket) }}">Ver</a>
                            <a href="{{ route('tickets.edit', $ticket) }}">Editar</a>

                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>