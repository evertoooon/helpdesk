<x-app-layout>

    <div class="space-y-8 max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div class="flex items-center gap-5">

                <div class="w-16 h-16 rounded-3xl bg-purple-500/20 border border-purple-300/30 shadow-[0_0_30px_rgba(168,85,247,0.40)] flex items-center justify-center">

                    <svg class="w-8 h-8 text-purple-300"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" />

                    </svg>

                </div>

                <div>

                    <h1 class="text-5xl font-bold bg-gradient-to-r from-purple-300 via-white to-blue-300 bg-clip-text text-transparent">
                        Detalhes da Categoria
                    </h1>

                    <p class="text-blue-100 mt-2 text-lg">
                        Visualize as informações cadastradas e como esta categoria orienta os usuários.
                    </p>

                </div>

            </div>

            <a href="{{ route('categories.index') }}"
                class="action-btn bg-white/10 hover:bg-white/20 text-white px-7 py-4 rounded-2xl font-bold border border-white/10 transition">

                Voltar

            </a>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div class="flex items-center gap-5">

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

                    <div>

                        <h2 class="text-3xl font-bold text-white">
                            {{ $category->name }}
                        </h2>

                        <p class="text-blue-200 mt-1">
                            Criada em {{ $category->created_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                </div>

                @if($category->active)

                <span class="status-pill inline-flex items-center gap-2 bg-green-500/20 text-green-200 border border-green-300/20 rounded-full px-5 py-2 text-sm font-bold">

                    <span class="w-2 h-2 rounded-full bg-green-300"></span>

                    Ativa

                </span>

                @else

                <span class="status-pill inline-flex items-center gap-2 bg-red-500/20 text-red-200 border border-red-300/20 rounded-full px-5 py-2 text-sm font-bold">

                    <span class="w-2 h-2 rounded-full bg-red-300"></span>

                    Inativa

                </span>

                @endif

            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="glass-card bg-white/10 border border-white/10 rounded-2xl p-5">

                    <p class="text-blue-200 text-sm">
                        Nome da categoria
                    </p>

                    <p class="font-bold text-white text-xl mt-1 break-words">
                        {{ $category->name }}
                    </p>

                </div>

                <div class="glass-card bg-white/10 border border-white/10 rounded-2xl p-5">

                    <p class="text-blue-200 text-sm">
                        Última atualização
                    </p>

                    <p class="font-bold text-white text-xl mt-1">
                        {{ $category->updated_at->format('d/m/Y H:i') }}
                    </p>

                </div>

            </div>

            <div class="px-6 pb-6">

                <div class="glass-card bg-white/10 border border-white/10 rounded-2xl p-6">

                    <h3 class="text-2xl font-bold text-white mb-4">
                        Descrição da categoria
                    </h3>

                    <div class="text-blue-100 leading-relaxed whitespace-pre-line break-words">

                        {{ $category->description ?: 'Nenhuma descrição cadastrada.' }}

                    </div>

                </div>

            </div>

        </div>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('categories.edit', $category) }}"
                class="action-btn bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(59,130,246,0.35)] transition">

                Editar Categoria

            </a>

            <a href="{{ route('categories.index') }}"
                class="action-btn bg-white/10 hover:bg-white/20 text-white px-7 py-4 rounded-2xl font-bold border border-white/10 transition">

                Voltar para lista

            </a>

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

                    card.style.background =
                        'radial-gradient(circle at ' +
                        x + 'px ' +
                        y + 'px, rgba(255,255,255,0.18), transparent 35%), ' +
                        'linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02))';

                });

                card.addEventListener('mouseleave', function() {
                    card.style.background = '';
                });

            });

            buttons.forEach(function(button) {

                button.addEventListener('mouseenter', function() {
                    button.style.transform = 'scale(1.03)';
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