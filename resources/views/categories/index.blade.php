<x-app-layout>

    <div class="py-6 max-w-7xl mx-auto">

        <div class="flex justify-between mb-6">

            <h1 class="text-2xl font-bold">
                Categorias
            </h1>

            <a href="{{ route('categories.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">

                Nova Categoria

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

                <th class="p-2">Nome</th>

                <th class="p-2">Descrição</th>

                <th class="p-2">Status</th>

                <th class="p-2">Ações</th>

            </tr>

            </thead>

            <tbody>

            @foreach($categories as $category)

            <tr class="border">

                <td class="p-2">
                    {{ $category->name }}
                </td>

                <td class="p-2">
                    {{ $category->description }}
                </td>

                <td class="p-2">

                    @if($category->active)

                        Ativa

                    @else

                        Inativa

                    @endif

                </td>

                <td class="p-2 flex gap-2">

                    <a href="{{ route('categories.show',$category) }}">
                        Ver
                    </a>

                    <a href="{{ route('categories.edit',$category) }}">
                        Editar
                    </a>

                    <form action="{{ route('categories.destroy',$category) }}"
                          method="POST">

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