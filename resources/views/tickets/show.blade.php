<x-app-layout>

    <div class="space-y-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div class="flex items-center gap-5">

                <div class="w-16 h-16 rounded-3xl bg-purple-500/20 border border-purple-300/30 shadow-[0_0_30px_rgba(168,85,247,.40)] flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-5xl font-bold bg-gradient-to-r from-purple-300 via-white to-blue-300 bg-clip-text text-transparent">
                        Detalhes do Chamado
                    </h1>

                    <p class="text-blue-100 mt-2 text-lg">
                        Acompanhe as informações e atualizações deste atendimento.
                    </p>
                </div>

            </div>

            <a href="{{ route('tickets.index') }}"
               class="action-btn bg-white/10 hover:bg-white/20 text-white px-7 py-4 rounded-2xl font-bold border border-white/10 transition">
                Voltar
            </a>

        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-300/30 text-green-100 p-4 rounded-2xl backdrop-blur-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex flex-col md:flex-row md:items-start md:justify-between gap-5">

                <div>
                    <p class="text-blue-200 font-semibold">
                        Chamado #{{ $ticket->id }}
                    </p>

                    <h2 class="text-3xl font-bold text-white mt-1">
                        {{ $ticket->title }}
                    </h2>

                    <p class="text-blue-200 mt-2">
                        Aberto por {{ $ticket->user->name }} em {{ $ticket->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">

                    @if($ticket->status == 'Aberto')
                        <span class="status-pill inline-flex items-center gap-2 bg-yellow-500/20 text-yellow-200 border border-yellow-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            <span class="w-2 h-2 rounded-full bg-yellow-300"></span>
                            Aberto
                        </span>
                    @elseif($ticket->status == 'Em andamento')
                        <span class="status-pill inline-flex items-center gap-2 bg-blue-500/20 text-blue-200 border border-blue-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            <span class="w-2 h-2 rounded-full bg-blue-300"></span>
                            Em andamento
                        </span>
                    @elseif($ticket->status == 'Resolvido')
                        <span class="status-pill inline-flex items-center gap-2 bg-green-500/20 text-green-200 border border-green-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            <span class="w-2 h-2 rounded-full bg-green-300"></span>
                            Resolvido
                        </span>
                    @else
                        <span class="status-pill inline-flex items-center gap-2 bg-red-500/20 text-red-200 border border-red-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            <span class="w-2 h-2 rounded-full bg-red-300"></span>
                            Cancelado
                        </span>
                    @endif

                    @if($ticket->priority == 'Baixa')
                        <span class="status-pill inline-flex items-center gap-2 bg-green-500/20 text-green-200 border border-green-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            Prioridade Baixa
                        </span>
                    @elseif($ticket->priority == 'Média')
                        <span class="status-pill inline-flex items-center gap-2 bg-yellow-500/20 text-yellow-200 border border-yellow-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            Prioridade Média
                        </span>
                    @elseif($ticket->priority == 'Alta')
                        <span class="status-pill inline-flex items-center gap-2 bg-orange-500/20 text-orange-200 border border-orange-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            Prioridade Alta
                        </span>
                    @else
                        <span class="urgent-pill inline-flex items-center gap-2 bg-red-500/20 text-red-200 border border-red-300/20 rounded-full px-5 py-2 text-sm font-bold">
                            Prioridade Urgente
                        </span>
                    @endif

                </div>

            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="glass-card bg-white/10 border border-white/10 rounded-2xl p-5">
                    <p class="text-blue-200 text-sm">
                        Categoria
                    </p>

                    <p class="font-bold text-white text-xl mt-1">
                        {{ $ticket->category->name }}
                    </p>
                </div>

                <div class="glass-card bg-white/10 border border-white/10 rounded-2xl p-5">
                    <p class="text-blue-200 text-sm">
                        Última atualização
                    </p>

                    <p class="font-bold text-white text-xl mt-1">
                        {{ $ticket->updated_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div class="glass-card bg-white/10 border border-white/10 rounded-2xl p-5">
                    <p class="text-blue-200 text-sm">
                        Responsável
                    </p>

                    <p class="font-bold text-white text-xl mt-1">
                        Equipe de suporte
                    </p>
                </div>

            </div>

            <div class="px-6 pb-6">

                <div class="bg-white/10 border border-white/10 rounded-2xl p-6">
                    <h3 class="text-2xl font-bold text-white mb-3">
                        Descrição do problema
                    </h3>

                    <p class="text-blue-100 leading-relaxed whitespace-pre-line">
                        {{ $ticket->description }}
                    </p>
                </div>

            </div>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex items-center gap-4">

                <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,.35)]">
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-4.5-7.8"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Histórico do Chamado
                </h2>

            </div>

            <div class="p-6">

                @if($ticket->comments->count() > 0)

                    <div class="space-y-5">

                        @foreach($ticket->comments as $comment)

                            <div class="flex gap-4 timeline-item">

                                <div class="w-12 h-12 rounded-2xl bg-blue-500/20 border border-blue-300/30 text-blue-100 flex items-center justify-center font-bold shrink-0 shadow-[0_0_20px_rgba(59,130,246,.25)]">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>

                                <div class="bg-white/10 border border-white/10 rounded-2xl p-5 flex-1">

                                    <p class="text-blue-200 text-sm mb-2">
                                        <strong class="text-white">
                                            {{ $comment->user->name }}
                                        </strong>
                                        comentou em {{ $comment->created_at->format('d/m/Y H:i') }}
                                    </p>

                                    <p class="text-blue-100 leading-relaxed whitespace-pre-line">
                                        {{ $comment->comment }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5 text-blue-100">
                        Ainda não há comentários ou atualizações neste chamado.
                    </div>

                @endif

            </div>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex items-center gap-4">

                <div class="w-11 h-11 rounded-2xl bg-green-500/20 border border-green-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,.35)]">
                    <svg class="w-6 h-6 text-green-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Adicionar atualização
                </h2>

            </div>

            <form method="POST" action="{{ route('tickets.comments.store', $ticket) }}" class="p-6">
                @csrf

                <div class="space-y-5">

                    <div>
                        <label class="block font-semibold text-blue-100 mb-2">
                            Comentário
                        </label>

                        <textarea
                            name="comment"
                            rows="5"
                            placeholder="Ex: Técnico iniciou a análise do problema."
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-blue-200 rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">{{ old('comment') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="action-btn bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(34,197,94,.35)] transition">
                        Salvar Comentário
                    </button>

                </div>

            </form>

        </div>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('tickets.edit', $ticket) }}"
               class="action-btn bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(59,130,246,.35)] transition">
                Editar Chamado
            </a>

            <a href="{{ route('tickets.index') }}"
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
            const urgentItems = document.querySelectorAll('.urgent-pill');
            const timelineItems = document.querySelectorAll('.timeline-item');

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

            // Pulso suave nos status
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

            // Pulso mais forte para prioridade urgente
            urgentItems.forEach(function (item) {
                item.animate(
                    [
                        { transform: 'scale(1)', opacity: 1 },
                        { transform: 'scale(1.08)', opacity: .75 },
                        { transform: 'scale(1)', opacity: 1 }
                    ],
                    {
                        duration: 1200,
                        iterations: Infinity
                    }
                );
            });

            // Entrada suave dos comentários
            timelineItems.forEach(function (item, index) {
                item.style.opacity = '0';
                item.style.transform = 'translateY(12px)';

                setTimeout(function () {
                    item.style.transition = 'opacity 400ms ease, transform 400ms ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 120);
            });
        });
    </script>

</x-app-layout>