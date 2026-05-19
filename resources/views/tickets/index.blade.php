<x-app-layout>

    <div class="space-y-8 tickets-page">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div class="flex items-center gap-5">

                <div class="w-16 h-16 rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_30px_rgba(59,130,246,0.45)] flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M7 4h10a2 2 0 012 2v14l-4-2-3 2-3-2-4 2V6a2 2 0 012-2z"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">
                        Chamados
                    </h1>

                    <p class="text-blue-100 mt-2 text-lg">
                        Acompanhe, analise e gerencie as solicitações registradas no sistema.
                    </p>
                </div>

            </div>

            <a href="{{ route('tickets.create') }}"
               class="action-btn inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(37,99,235,0.45)] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/>
                </svg>
                Novo Chamado
            </a>

        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-300/30 text-green-100 p-4 rounded-2xl backdrop-blur-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="glass-card bg-gradient-to-br from-blue-500/20 to-blue-950/30 backdrop-blur-xl rounded-3xl border border-blue-300/30 p-7 shadow-[0_0_35px_rgba(59,130,246,0.25)]">
                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-3xl bg-blue-500/25 border border-blue-300/30 shadow-[0_0_25px_rgba(59,130,246,0.45)] flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M7 4h10a2 2 0 012 2v14l-4-2-3 2-3-2-4 2V6a2 2 0 012-2z"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-blue-100">
                            Total
                        </p>

                        <p class="text-5xl font-bold text-white mt-2">
                            {{ $tickets->count() }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="glass-card bg-gradient-to-br from-yellow-500/20 to-orange-950/30 backdrop-blur-xl rounded-3xl border border-yellow-300/30 p-7 shadow-[0_0_35px_rgba(245,158,11,0.20)]">
                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-3xl bg-yellow-500/25 border border-yellow-300/30 shadow-[0_0_25px_rgba(245,158,11,0.45)] flex items-center justify-center">
                        <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v5l3 2"/>
                            <circle cx="12" cy="12" r="9"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-yellow-100">
                            Abertos
                        </p>

                        <p class="text-5xl font-bold text-yellow-300 mt-2">
                            {{ $tickets->where('status', 'Aberto')->count() }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="glass-card bg-gradient-to-br from-purple-500/20 to-blue-950/30 backdrop-blur-xl rounded-3xl border border-purple-300/30 p-7 shadow-[0_0_35px_rgba(168,85,247,0.20)]">
                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-3xl bg-purple-500/25 border border-purple-300/30 shadow-[0_0_25px_rgba(168,85,247,0.45)] flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v6h6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 20v-6h-6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a9 9 0 0114-14"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-purple-100">
                            Em andamento
                        </p>

                        <p class="text-5xl font-bold text-purple-300 mt-2">
                            {{ $tickets->where('status', 'Em andamento')->count() }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="glass-card bg-gradient-to-br from-green-500/20 to-emerald-950/30 backdrop-blur-xl rounded-3xl border border-green-300/30 p-7 shadow-[0_0_35px_rgba(34,197,94,0.20)]">
                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-3xl bg-green-500/25 border border-green-300/30 shadow-[0_0_25px_rgba(34,197,94,0.45)] flex items-center justify-center">
                        <svg class="w-9 h-9 text-green-200" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-green-100">
                            Resolvidos
                        </p>

                        <p class="text-5xl font-bold text-green-300 mt-2">
                            {{ $tickets->where('status', 'Resolvido')->count() }}
                        </p>
                    </div>

                </div>
            </div>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex items-center gap-4">

                <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.35)]">
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Lista de chamados
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-white/10">
                        <tr>
                            <th class="p-5 text-left text-blue-100">Chamado</th>
                            <th class="p-5 text-left text-blue-100">Categoria</th>
                            <th class="p-5 text-left text-blue-100">Prioridade</th>
                            <th class="p-5 text-left text-blue-100">Status</th>
                            <th class="p-5 text-left text-blue-100">Usuário</th>
                            <th class="p-5 text-left text-blue-100">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/10">

                        @forelse($tickets as $ticket)

                            <tr class="hover:bg-white/10 transition duration-300">

                                <td class="p-5">
                                    <div>
                                        <p class="font-bold text-white text-lg">
                                            #{{ $ticket->id }} - {{ $ticket->title }}
                                        </p>

                                        <p class="text-blue-200 text-sm mt-1">
                                            Criado em {{ $ticket->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </td>

                                <td class="p-5">
                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-2xl bg-blue-500/20 border border-blue-300/30 text-blue-200 flex items-center justify-center shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z"/>
                                            </svg>
                                        </div>

                                        <span class="font-semibold text-white">
                                            {{ $ticket->category->name }}
                                        </span>

                                    </div>
                                </td>

                                <td class="p-5">

                                    @if($ticket->priority == 'Baixa')
                                        <span class="status-pill inline-flex items-center gap-2 bg-green-500/20 text-green-200 border border-green-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-green-300"></span>
                                            Baixa
                                        </span>
                                    @elseif($ticket->priority == 'Média')
                                        <span class="status-pill inline-flex items-center gap-2 bg-yellow-500/20 text-yellow-200 border border-yellow-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-yellow-300"></span>
                                            Média
                                        </span>
                                    @elseif($ticket->priority == 'Alta')
                                        <span class="status-pill inline-flex items-center gap-2 bg-orange-500/20 text-orange-200 border border-orange-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-orange-300"></span>
                                            Alta
                                        </span>
                                    @else
                                        <span class="urgent-pill inline-flex items-center gap-2 bg-red-500/20 text-red-200 border border-red-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-red-300"></span>
                                            Urgente
                                        </span>
                                    @endif

                                </td>

                                <td class="p-5">

                                    @if($ticket->status == 'Aberto')
                                        <span class="status-pill inline-flex items-center gap-2 bg-yellow-500/20 text-yellow-200 border border-yellow-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-yellow-300"></span>
                                            Aberto
                                        </span>
                                    @elseif($ticket->status == 'Em andamento')
                                        <span class="status-pill inline-flex items-center gap-2 bg-blue-500/20 text-blue-200 border border-blue-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-blue-300"></span>
                                            Em andamento
                                        </span>
                                    @elseif($ticket->status == 'Resolvido')
                                        <span class="status-pill inline-flex items-center gap-2 bg-green-500/20 text-green-200 border border-green-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-green-300"></span>
                                            Resolvido
                                        </span>
                                    @else
                                        <span class="status-pill inline-flex items-center gap-2 bg-red-500/20 text-red-200 border border-red-300/20 rounded-full px-4 py-2 text-sm font-bold">
                                            <span class="w-2 h-2 rounded-full bg-red-300"></span>
                                            Cancelado
                                        </span>
                                    @endif

                                </td>

                                <td class="p-5 text-blue-100">
                                    {{ $ticket->user->name }}
                                </td>

                                <td class="p-5">

                                    <div class="flex flex-nowrap items-center gap-3">

                                        <a href="{{ route('tickets.show', $ticket) }}"
                                           class="action-btn inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white rounded-xl px-4 py-2 transition border border-white/10 whitespace-nowrap">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                            Ver
                                        </a>

                                        <a href="{{ route('tickets.edit', $ticket) }}"
                                           class="action-btn inline-flex items-center gap-2 bg-blue-500/25 hover:bg-blue-500/40 text-blue-100 rounded-xl px-4 py-2 transition border border-blue-300/20 whitespace-nowrap">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                            </svg>
                                            Editar
                                        </a>

                                        <form action="{{ route('tickets.destroy', $ticket) }}"
                                              method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este chamado?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-btn inline-flex items-center gap-2 bg-red-500/25 hover:bg-red-500/40 text-red-100 rounded-xl px-4 py-2 transition border border-red-300/20 whitespace-nowrap">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l1 14h10l1-14"/>
                                                </svg>
                                                Excluir
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="p-8 text-center text-blue-100">
                                    Nenhum chamado cadastrado até o momento.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.glass-card');
            const buttons = document.querySelectorAll('.action-btn');
            const statusItems = document.querySelectorAll('.status-pill');
            const urgentItems = document.querySelectorAll('.urgent-pill');

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
        });
    </script>

</x-app-layout>