<x-app-layout>

    <div class="py-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-5">

            Editar Categoria

        </h1>

        <form method="POST"
              action="{{ route('categories.update', $category) }}">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-1">

                    Nome

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $category->name }}"
                    class="w-full border rounded p-2">

            </div>

            <div class="mb-4">

                <label class="block mb-1">

                    Descrição

                </label>

                <textarea
                    name="description"
                    class="w-full border rounded p-2"
                    rows="4">{{ $category->description }}</textarea>

            </div>

            <div class="mb-5">

                <label>

                    <input
                        type="checkbox"
                        name="active"
                        {{ $category->active ? 'checked' : '' }}>

                    Categoria ativa

                </label>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">

                    Atualizar

                </button>

                <a href="{{ route('categories.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">

                    Voltar

                </a>

            </div>

        </form>

    </div>

</x-app-layout>