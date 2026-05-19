<x-app-layout>
    <div class="py-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-5">
            Editar Chamado
        </h1>

        @if ($errors->any())
            <div class="bg-red-200 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tickets.update', $ticket) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Categoria</label>

                <select name="category_id" class="w-full border rounded p-2">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} - {{ $category->description }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Título do problema</label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $ticket->title) }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Descrição detalhada</label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded p-2">{{ old('description', $ticket->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Prioridade</label>

                <select name="priority" class="w-full border rounded p-2">
                    <option value="Baixa" {{ $ticket->priority == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                    <option value="Média" {{ $ticket->priority == 'Média' ? 'selected' : '' }}>Média</option>
                    <option value="Alta" {{ $ticket->priority == 'Alta' ? 'selected' : '' }}>Alta</option>
                    <option value="Urgente" {{ $ticket->priority == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                </select>
            </div>

            <div class="mb-5">
                <label class="block mb-1">Status</label>

                <select name="status" class="w-full border rounded p-2">
                    <option value="Aberto" {{ $ticket->status == 'Aberto' ? 'selected' : '' }}>Aberto</option>
                    <option value="Em andamento" {{ $ticket->status == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="Resolvido" {{ $ticket->status == 'Resolvido' ? 'selected' : '' }}>Resolvido</option>
                    <option value="Cancelado" {{ $ticket->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                    Atualizar Chamado
                </button>

                <a href="{{ route('tickets.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Voltar
                </a>
            </div>

        </form>

    </div>
</x-app-layout>