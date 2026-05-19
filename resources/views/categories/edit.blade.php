<x-app-layout>

    <div class="space-y-8">

        <div class="flex items-center gap-5">

            <div class="w-16 h-16 rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_30px_rgba(59,130,246,0.40)] flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
            </div>

            <div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">
                    Editar Categoria
                </h1>

                <p class="text-blue-100 mt-2 text-lg">
                    Atualize as informações e a disponibilidade desta categoria.
                </p>
            </div>

        </div>

        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-300/30 text-red-100 p-4 rounded-2xl backdrop-blur-xl">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex items-center gap-4">

                <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.35)]">
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Dados da categoria
                </h2>

            </div>

            <form method="POST" action="{{ route('categories.update', $category) }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <div>
                        <label class="block font-semibold text-blue-100 mb-2">
                            Nome da categoria
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-blue-200 rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">

                        <p class="text-sm text-blue-200 mt-2">
                            Utilize nomes claros para facilitar a escolha do usuário.
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-blue-100 mb-2">
                            Descrição
                        </label>

                        <textarea
                            name="description"
                            rows="6"
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-blue-200 rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">{{ old('description', $category->description) }}</textarea>

                        <p class="text-sm text-blue-200 mt-2">
                            Esta descrição será exibida como apoio ao usuário na abertura de chamados.
                        </p>
                    </div>

                    <div class="bg-blue-500/10 border border-blue-300/20 rounded-2xl p-5">

                        <label class="flex items-center gap-3 text-blue-100 font-semibold">

                            <input
                                type="checkbox"
                                name="active"
                                {{ $category->active ? 'checked' : '' }}
                                class="rounded border-white/20 bg-white/10 text-blue-600 focus:ring-blue-500">

                            Categoria ativa

                        </label>

                        <p class="text-sm text-blue-200 mt-2">
                            Se desativada, esta categoria não aparecerá para novos chamados.
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">

                        <button
                            type="submit"
                            class="action-btn bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(59,130,246,0.35)] transition">
                            Atualizar Categoria
                        </button>

                        <a href="{{ route('categories.index') }}"
                           class="action-btn bg-white/10 hover:bg-white/20 text-white px-7 py-4 rounded-2xl font-bold border border-white/10 transition">
                            Voltar
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.action-btn');

            // Efeito visual nos botões
            buttons.forEach(function (button) {
                button.addEventListener('mouseenter', function () {
                    button.style.transform = 'scale(1.04)';
                    button.style.boxShadow = '0 0 25px rgba(255,255,255,.15)';
                });

                button.addEventListener('mouseleave', function () {
                    button.style.transform = 'scale(1)';
                    button.style.boxShadow = '';
                });
            });
        });
    </script>

</x-app-layout>