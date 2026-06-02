<x-app-layout>

    <div class="space-y-8 category-page">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_30px_rgba(59,130,246,0.45)] flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">
                        Categorias
                    </h1>

                    <p class="text-blue-100 mt-2 text-lg">
                        Gerencie os tipos de problemas disponíveis para abertura de chamados.
                    </p>
                </div>
            </div>

            <a href="{{ route('categories.create') }}"
                class="action-btn inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(37,99,235,0.45)] transition hover:scale-105">
                Nova Categoria
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-500/20 border border-green-300/30 text-green-100 p-4 rounded-2xl backdrop-blur-xl">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-500/20 border border-red-300/30 text-red-100 p-4 rounded-2xl backdrop-blur-xl">
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="glass-card bg-gradient-to-br from-blue-500/20 to-blue-950/30 backdrop-blur-xl rounded-3xl border border-blue-300/30 p-7 shadow-[0_0_35px_rgba(59,130,246,0.25)]">
                <p class="text-blue-100">Total de categorias</p>
                <p class="text-5xl font-bold text-white mt-2">{{ $categories->count() }}</p>
            </div>

            <div class="glass-card bg-gradient-to-br from-green-500/20 to-emerald-950/30 backdrop-blur-xl rounded-3xl border border-green-300/30 p-7 shadow-[0_0_35px_rgba(34,197,94,0.20)]">
                <p class="text-green-100">Categorias ativas</p>
                <p class="text-5xl font-bold text-green-300 mt-2">{{ $categories->where('active', true)->count() }}</p>
            </div>

            <div class="glass-card bg-gradient-to-br from-red-500/20 to-purple-950/30 backdrop-blur-xl rounded-3xl border border-red-300/30 p-7 shadow-[0_0_35px_rgba(239,68,68,0.20)]">
                <p class="text-red-100">Categorias inativas</p>
                <p class="text-5xl font-bold text-red-300 mt-2">{{ $categories->where('active', false)->count() }}</p>
            </div>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.35)]">
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Lista de categorias
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">

                    <thead class="bg-white/10">
                        <tr>
                            <th class="p-5 text-left text-blue-100">Nome</th>
                            <th class="p-5 text-left text-blue-100">Descrição</th>
                            <th class="p-5 text-left text-blue-100">Status</th>
                            <th class="p-5 text-left text-blue-100">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/10">

                        @forelse($categories as $category)
                        <tr class="hover:bg-white/10 transition duration-300">

                            <td class="p-5">
                                <div class="w-16 h-16 rounded-3xl bg-blue-500/20 border border-blue-300/30 text-blue-200 flex items-center justify-center shadow-[0_0_25px_rgba(59,130,246,0.35)]">

                                    @switch($category->name)

                                    @case('Hardware')
                                    🖥️
                                    @break

                                    @case('Software')
                                    💻
                                    @break

                                    @case('Rede')
                                    🌐
                                    @break

                                    @case('Segurança')
                                    🔒
                                    @break

                                    @case('E-mail')
                                    ✉️
                                    @break

                                    @case('Impressora')
                                    🖨️
                                    @break

                                    @case('Acesso')
                                    🔑
                                    @break

                                    @case('Sistema')
                                    ⚙️
                                    @break

                                    @default
                                    📂

                                    @endswitch

                                </div>

                                <span class="font-bold text-white whitespace-nowrap">
                                    {{ $category->name }}
                                </span>
            </div>
            </td>

            <td class="p-5 text-blue-100 leading-relaxed max-w-2xl">
                {{ $category->description ?? 'Sem descrição cadastrada.' }}
            </td>

            <td class="p-5">
                @if($category->active)
                <span class="status-pill inline-flex items-center gap-2 bg-green-500/20 text-green-200 border border-green-300/20 rounded-full px-4 py-2 text-sm font-bold">
                    <span class="w-2 h-2 rounded-full bg-green-300"></span>
                    Ativa
                </span>
                @else
                <span class="status-pill inline-flex items-center gap-2 bg-red-500/20 text-red-200 border border-red-300/20 rounded-full px-4 py-2 text-sm font-bold">
                    <span class="w-2 h-2 rounded-full bg-red-300"></span>
                    Inativa
                </span>
                @endif
            </td>

            <td class="p-5">
                <div class="flex flex-nowrap items-center gap-3">

                    <a href="{{ route('categories.show', $category) }}"
                        class="action-btn inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white rounded-xl px-4 py-2 transition border border-white/10 whitespace-nowrap">
                        Ver
                    </a>

                    <a href="{{ route('categories.edit', $category) }}"
                        class="action-btn inline-flex items-center gap-2 bg-blue-500/25 hover:bg-blue-500/40 text-blue-100 rounded-xl px-4 py-2 transition border border-blue-300/20 whitespace-nowrap">
                        Editar
                    </a>

                    <form
                        action="{{ route('categories.destroy', $category) }}"
                        method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="action-btn inline-flex items-center gap-2 bg-red-500/25 hover:bg-red-500/40 text-red-100 rounded-xl px-4 py-2 transition border border-red-300/20 whitespace-nowrap">
                            Excluir
                        </button>
                    </form>

                </div>
            </td>

            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-8 text-center text-blue-100">
                    Nenhuma categoria cadastrada até o momento.
                </td>
            </tr>
            @endforelse

            </tbody>

            </table>
        </div>

    </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.glass-card');
            const buttons = document.querySelectorAll('.action-btn');
            const statusItems = document.querySelectorAll('.status-pill');

            cards.forEach(function(card) {
                card.addEventListener('mousemove', function(event) {
                    const rect = card.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    card.style.background = 'radial-gradient(circle at ' + x + 'px ' + y + 'px, rgba(255,255,255,0.18), transparent 35%), linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02))';
                });

                card.addEventListener('mouseleave', function() {
                    card.style.background = '';
                });
            });

            buttons.forEach(function(button) {
                button.addEventListener('mouseenter', function() {
                    button.style.transform = 'scale(1.04)';
                    button.style.boxShadow = '0 0 25px rgba(255,255,255,.15)';
                });

                button.addEventListener('mouseleave', function() {
                    button.style.transform = 'scale(1)';
                    button.style.boxShadow = '';
                });
            });

            statusItems.forEach(function(item) {
                item.animate(
                    [{
                            opacity: 1
                        },
                        {
                            opacity: 0.75
                        },
                        {
                            opacity: 1
                        }
                    ], {
                        duration: 1800,
                        iterations: Infinity
                    }
                );
            });
        });
    </script>

</x-app-layout>