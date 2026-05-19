<x-app-layout>

    <div class="space-y-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div class="flex items-center gap-5">

                <div class="w-16 h-16 rounded-3xl bg-purple-500/20 border border-purple-300/30 shadow-[0_0_30px_rgba(168,85,247,0.40)] flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
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

            <div class="p-6 border-b border-white/10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl
                        @if($category->name == 'Acesso') bg-blue-500/20 border-blue-300/30 text-blue-200
                        @elseif($category->name == 'E-mail') bg-purple-500/20 border-purple-300/30 text-purple-200
                        @elseif($category->name == 'Hardware') bg-indigo-500/20 border-indigo-300/30 text-indigo-200
                        @elseif($category->name == 'Impressora') bg-yellow-500/20 border-yellow-300/30 text-yellow-200
                        @elseif($category->name == 'Manutenção') bg-orange-500/20 border-orange-300/30 text-orange-200
                        @elseif($category->name == 'Outros') bg-slate-500/20 border-slate-300/30 text-slate-200
                        @elseif($category->name == 'Rede') bg-cyan-500/20 border-cyan-300/30 text-cyan-200
                        @elseif($category->name == 'Servidor') bg-red-500/20 border-red-300/30 text-red-200
                        @elseif($category->name == 'Sistema') bg-emerald-500/20 border-emerald-300/30 text-emerald-200
                        @elseif($category->name == 'Software') bg-pink-500/20 border-pink-300/30 text-pink-200
                        @else bg-white/10 border-white/20 text-white
                        @endif
                        border flex items-center justify-center shadow-lg">

                        @if($category->name == 'Acesso')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.105 0 2-.895 2-2V7a2 2 0 1 0-4 0v2c0 1.105.895 2 2 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 11h14v9H5z"/>
                            </svg>
                        @elseif($category->name == 'E-mail')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7l8 6 8-6"/>
                            </svg>
                        @elseif($category->name == 'Hardware')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16v11H4z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8M12 16v5"/>
                            </svg>
                        @elseif($category->name == 'Impressora')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V3h12v6"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 14h12v7H6z"/>
                            </svg>
                        @elseif($category->name == 'Manutenção')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a4 4 0 0 0-5 5L3 18l3 3 6.7-6.7a4 4 0 0 0 5-5l-2.4 2.4-3-3 2.4-2.4z"/>
                            </svg>
                        @elseif($category->name == 'Outros')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 9a2.5 2.5 0 1 1 4.5 1.5c-.8.8-2 1.3-2 2.5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01"/>
                            </svg>
                        @elseif($category->name == 'Rede')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="5" r="2"/>
                                <circle cx="5" cy="19" r="2"/>
                                <circle cx="19" cy="19" r="2"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v4M12 11L5 17M12 11l7 6"/>
                            </svg>
                        @elseif($category->name == 'Servidor')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="4" y="3" width="16" height="7" rx="2"/>
                                <rect x="4" y="14" width="16" height="7" rx="2"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h.01M8 18h.01"/>
                            </svg>
                        @elseif($category->name == 'Sistema')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2l2.5 5 5.5.8-4 3.9.9 5.5L12 14.6 7.1 17.2l.9-5.5-4-3.9 5.5-.8L12 2z"/>
                            </svg>
                        @elseif($category->name == 'Software')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l-4 3 4 3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 9l4 3-4 3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 4l-4 16"/>
                            </svg>
                        @endif

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
                        Nome
                    </p>

                    <p class="font-bold text-white text-xl mt-1">
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

                <div class="bg-white/10 border border-white/10 rounded-2xl p-6">
                    <h3 class="text-2xl font-bold text-white mb-3">
                        Descrição da categoria
                    </h3>

                    <p class="text-blue-100 leading-relaxed whitespace-pre-line">
                        {{ $category->description ?? 'Nenhuma descrição cadastrada.' }}
                    </p>
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
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.glass-card');
            const buttons = document.querySelectorAll('.action-btn');
            const statusItems = document.querySelectorAll('.status-pill');

            // Efeito de brilho nos cards
            cards.forEach(function (card) {
                card.addEventListener('mousemove', function (event) {
                    const rect = card.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    card.style.background = `
                        radial-gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.18), transparent 35%),
                        linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02))
                    `;
                });

                card.addEventListener('mouseleave', function () {
                    card.style.background = '';
                });
            });

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

            // Pulso suave no status
            statusItems.forEach(function (item) {
                item.animate(
                    [
                        { opacity: 1 },
                        { opacity: .75 },
                        { opacity: 1 }
                    ],
                    {
                        duration: 1800,
                        iterations: Infinity
                    }
                );
            });
        });
    </script>

</x-app-layout>