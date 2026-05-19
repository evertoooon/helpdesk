<x-app-layout>

    <div class="py-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-5">
            Nova Categoria
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

        <form method="POST" action="{{ route('categories.store') }}">

            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nome</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Descrição</label>

                <textarea
                    name="description"
                    class="w-full border rounded p-2"
                    rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-5">
                <label>
                    <input type="checkbox" name="active" checked>
                    Categoria ativa
                </label>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded">
                    Salvar
                </button>

                <a href="{{ route('categories.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Voltar
                </a>
            </div>

        </form>

    </div>

</x-app-layout>