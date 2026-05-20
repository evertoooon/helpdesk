<x-app-layout>

    @php
        $totalCategories = \App\Models\Category::count();
        $activeCategories = \App\Models\Category::where('active', true)->count();

        $totalTickets = \App\Models\Ticket::count();
        $openTickets = \App\Models\Ticket::where('status', 'Aberto')->count();
        $progressTickets = \App\Models\Ticket::where('status', 'Em andamento')->count();
        $resolvedTickets = \App\Models\Ticket::where('status', 'Resolvido')->count();
    @endphp

    <div class="space-y-8 dashboard-page">

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden hero-card">

            <div class="p-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div>
                    <p id="greeting" class="text-blue-200 text-lg font-semibold">
                        Olá,
                    </p>

                    <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent mt-2">
                        {{ Auth::user()->name }}
                    </h1>

                    <p class="text-blue-100 mt-4 text-lg max-w-3xl">
                        Bem-vindo ao HelpDesk. Acompanhe chamados, organize categorias e mantenha o suporte funcionando de forma clara e eficiente.
                    </p>
                </div>

                <div class="w-28 h-28 rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_35px_rgba(59,130,246,.45)] flex items-center justify-center">
                    <svg class="w-14 h-14 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M7 4h10a2 2 0 012 2v14l-4-2-3 2-3-2-4 2V6a2 2 0 012-2z"/>
                    </svg>
                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="glass-card bg-gradient-to-br from-blue-500/20 to-blue-950/30 backdrop-blur-xl rounded-3xl border border-blue-300/30 p-7 shadow-[0_0_35px_rgba(59,130,246,0.25)]">
                <div class="flex items-center justify-between gap-5">
                    <div>
                        <p class="text-blue-100">Total de chamados</p>
                        <p class="counter text-5xl font-bold text-white mt-2" data-target="{{ $totalTickets }}">0</p>
                    </div>

                    <div class="w-16 h-16 rounded-3xl bg-blue-500/25 border border-blue-300/30 shadow-[0_0_25px_rgba(59,130,246,0.45)] flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M7 4h10a2 2 0 012 2v14l-4-2-3 2-3-2-4 2V6a2 2 0 012-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="glass-card bg-gradient-to-br from-yellow-500/20 to-orange-950/30 backdrop-blur-xl rounded-3xl border border-yellow-300/30 p-7 shadow-[0_0_35px_rgba(245,158,11,0.20)]">
                <div class="flex items-center justify-between gap-5">
                    <div>
                        <p class="text-yellow-100">Chamados abertos</p>
                        <p class="counter text-5xl font-bold text-yellow-300 mt-2" data-target="{{ $openTickets }}">0</p>
                    </div>

                    <div class="w-16 h-16 rounded-3xl bg-yellow-500/25 border border-yellow-300/30 shadow-[0_0_25px_rgba(245,158,11,0.45)] flex items-center justify-center">
                        <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v5l3 2"/>
                            <circle cx="12" cy="12" r="9"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="glass-card bg-gradient-to-br from-purple-500/20 to-blue-950/30 backdrop-blur-xl rounded-3xl border border-purple-300/30 p-7 shadow-[0_0_35px_rgba(168,85,247,0.20)]">
                <div class="flex items-center justify-between gap-5">
                    <div>
                        <p class="text-purple-100">Em andamento</p>
                        <p class="counter text-5xl font-bold text-purple-300 mt-2" data-target="{{ $progressTickets }}">0</p>
                    </div>

                    <div class="w-16 h-16 rounded-3xl bg-purple-500/25 border border-purple-300/30 shadow-[0_0_25px_rgba(168,85,247,0.45)] flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v6h6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 20v-6h-6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a9 9 0 0114-14"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="glass-card bg-gradient-to-br from-green-500/20 to-emerald-950/30 backdrop-blur-xl rounded-3xl border border-green-300/30 p-7 shadow-[0_0_35px_rgba(34,197,94,0.20)]">
                <div class="flex items-center justify-between gap-5">
                    <div>
                        <p class="text-green-100">Resolvidos</p>
                        <p class="counter text-5xl font-bold text-green-300 mt-2" data-target="{{ $resolvedTickets }}">0</p>
                    </div>

                    <div class="w-16 h-16 rounded-3xl bg-green-500/25 border border-green-300/30 shadow-[0_0_25px_rgba(34,197,94,0.45)] flex items-center justify-center">
                        <svg class="w-9 h-9 text-green-200" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('categories.index') }}" class="action-btn glass-card block bg-white/10 border border-white/10 rounded-3xl p-6 backdrop-blur-xl transition">
                <p class="text-blue-200">Categorias</p>
                <h2 class="text-3xl font-bold text-white mt-2">Organizar</h2>
                <p class="text-blue-100 mt-3">
                    {{ $activeCategories }} categorias ativas disponíveis para orientar os usuários.
                </p>
            </a>

            <a href="{{ route('tickets.index') }}" class="action-btn glass-card block bg-white/10 border border-white/10 rounded-3xl p-6 backdrop-blur-xl transition">
                <p class="text-purple-200">Chamados</p>
                <h2 class="text-3xl font-bold text-white mt-2">Acompanhar</h2>
                <p class="text-blue-100 mt-3">
                    Visualize chamados abertos, em andamento e resolvidos.
                </p>
            </a>

            <a href="{{ route('tickets.create') }}" class="action-btn glass-card block bg-white/10 border border-white/10 rounded-3xl p-6 backdrop-blur-xl transition">
                <p class="text-green-200">Atendimento</p>
                <h2 class="text-3xl font-bold text-white mt-2">Abrir chamado</h2>
                <p class="text-blue-100 mt-3">
                    Registre um novo problema para análise da equipe.
                </p>
            </a>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl p-6">

            <h2 class="text-2xl font-bold text-white mb-6">
                Fluxo do sistema
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-blue-300 text-3xl font-bold">01</div>
                    <h3 class="text-white font-bold mt-3">Usuário relata</h3>
                    <p class="text-blue-100 mt-2 text-sm">O problema é descrito com detalhes.</p>
                </div>

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-purple-300 text-3xl font-bold">02</div>
                    <h3 class="text-white font-bold mt-3">Chamado registrado</h3>
                    <p class="text-blue-100 mt-2 text-sm">O sistema salva categoria e status inicial.</p>
                </div>

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-yellow-300 text-3xl font-bold">03</div>
                    <h3 class="text-white font-bold mt-3">Equipe acompanha</h3>
                    <p class="text-blue-100 mt-2 text-sm">Atualizações são registradas no histórico.</p>
                </div>

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-green-300 text-3xl font-bold">04</div>
                    <h3 class="text-white font-bold mt-3">Problema resolvido</h3>
                    <p class="text-blue-100 mt-2 text-sm">O chamado é finalizado com solução registrada.</p>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const greeting = document.getElementById('greeting');
            const cards = document.querySelectorAll('.glass-card');
            const buttons = document.querySelectorAll('.action-btn');
            const counters = document.querySelectorAll('.counter');
            const steps = document.querySelectorAll('.flow-step');

            // Saudação conforme horário local
            const hour = new Date().getHours();

            if (hour < 12) {
                greeting.innerText = 'Bom dia,';
            } else if (hour < 18) {
                greeting.innerText = 'Boa tarde,';
            } else {
                greeting.innerText = 'Boa noite,';
            }

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

            // Efeito visual nos botões/cards clicáveis
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

            // Animação suave dos contadores
            counters.forEach(function (counter) {
                const target = Number(counter.dataset.target);
                let current = 0;
                const duration = 900;
                const start = performance.now();

                function animateCounter(time) {
                    const progress = Math.min((time - start) / duration, 1);
                    const value = Math.floor(progress * target);

                    counter.innerText = value;

                    if (progress < 1) {
                        requestAnimationFrame(animateCounter);
                    } else {
                        counter.innerText = target;
                    }
                }

                requestAnimationFrame(animateCounter);
            });

            // Entrada suave do fluxo
            steps.forEach(function (step, index) {
                step.style.opacity = '0';
                step.style.transform = 'translateY(14px)';

                setTimeout(function () {
                    step.style.transition = 'opacity 450ms ease, transform 450ms ease';
                    step.style.opacity = '1';
                    step.style.transform = 'translateY(0)';
                }, index * 130);
            });
        });
    </script>

</x-app-layout>