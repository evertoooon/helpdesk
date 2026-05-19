<x-app-layout>

    <div class="py-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-5">
            Novo Chamado
        </h1>

        <div class="bg-blue-100 p-4 rounded mb-5">
            <p>
                Preencha as informações abaixo com o máximo de detalhes possível.
                A prioridade do chamado será avaliada pela equipe responsável após a abertura.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-200 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">
                    Categoria do problema
                </label>

                <select
                    name="category_id"
                    id="category_id"
                    class="w-full border rounded p-2">

                    <option value="">
                        Selecione a categoria
                    </option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            data-description="{{ $category->description }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

                <p class="text-sm text-gray-600 mt-2">
                    Escolha a categoria que mais se aproxima do problema encontrado.
                    Se tiver dúvidas, leia a explicação exibida após selecionar uma opção.
                </p>

                <div
                    id="category-info"
                    class="hidden bg-gray-100 border border-gray-300 rounded p-4 mt-3">

                    <p class="font-bold mb-2">
                        Sobre esta categoria
                    </p>

                    <p class="mb-1">
                        Você selecionou:
                        <strong id="category-name"></strong>
                    </p>

                    <p
                        id="category-description"
                        class="text-sm text-gray-700 leading-relaxed break-words">
                    </p>

                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Título do problema
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Ex: Computador não liga"
                    class="w-full border rounded p-2">

                <p class="text-sm text-gray-600 mt-1">
                    Use um título curto e direto para resumir o problema.
                </p>
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Descrição detalhada
                </label>

                <textarea
                    name="description"
                    rows="6"
                    placeholder="Explique o que aconteceu, quando começou, onde ocorreu e se apareceu alguma mensagem de erro."
                    class="w-full border rounded p-2">{{ old('description') }}</textarea>

                <p class="text-sm text-gray-600 mt-1">
                    Quanto mais detalhes você informar, mais fácil será para a equipe entender e resolver o chamado.
                </p>
            </div>

            <div class="bg-yellow-100 p-4 rounded mb-5">
                <p>
                    Ao abrir o chamado, ele será registrado como
                    <strong>Aberto</strong>
                    e com prioridade inicial
                    <strong>Média</strong>.
                    A equipe responsável poderá alterar a prioridade após analisar o problema.
                </p>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded">
                    Abrir Chamado
                </button>

                <a href="{{ route('tickets.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Voltar
                </a>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const categoryInfo = document.getElementById('category-info');
            const categoryName = document.getElementById('category-name');
            const categoryDescription = document.getElementById('category-description');

            function updateCategoryInfo() {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];

                const name = selectedOption.getAttribute('data-name');
                const description = selectedOption.getAttribute('data-description');

                if (name && description) {
                    categoryName.textContent = name;
                    categoryDescription.textContent = description;
                    categoryInfo.classList.remove('hidden');
                } else {
                    categoryName.textContent = '';
                    categoryDescription.textContent = '';
                    categoryInfo.classList.add('hidden');
                }
            }

            categorySelect.addEventListener('change', updateCategoryInfo);

            updateCategoryInfo();
        });
    </script>

</x-app-layout>