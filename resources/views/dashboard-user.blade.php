<x-app-layout>

    <div class="space-y-8 dashboard-user-page">

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden hero-card">

            <div class="p-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div>
                    <p id="greeting" class="text-blue-200 text-lg font-semibold">
                        Olá,
                    </p>

                    <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent mt-2 break-words">
                        {{ auth()->user()->name }}
                    </h1>

                    <p class="text-blue-100 mt-4 text-lg max-w-3xl">
                        Bem-vindo ao seu painel de atendimento. Aqui você pode abrir chamados e acompanhar o andamento das suas solicitações.
                    </p>
                </div>

                <a href="{{ route('tickets.create') }}"
                   class="action-btn inline-flex items-center justify-center gap-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(34,197,94,.35)] transition">
                    Abrir chamado
                </a>

            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="glass-card bg-gradient-to-br from-yellow-500/20 to-orange-950/30 backdrop-blur-xl rounded-3xl border border-yellow-300/30 p-7 shadow-[0_0_35px_rgba(245,158,11,0.20)]">
                <p class="text-yellow-100">Meus chamados abertos</p>
                <p class="counter text-5xl font-bold text-yellow-300 mt-2" data-target="{{ $myOpenTickets ?? 0 }}">0</p>
            </div>

            <div class="glass-card bg-gradient-to-br from-purple-500/20 to-blue-950/30 backdrop-blur-xl rounded-3xl border border-purple-300/30 p-7 shadow-[0_0_35px_rgba(168,85,247,0.20)]">
                <p class="text-purple-100">Em andamento</p>
                <p class="counter text-5xl font-bold text-purple-300 mt-2" data-target="{{ $myProgressTickets ?? 0 }}">0</p>
            </div>

            <div class="glass-card bg-gradient-to-br from-green-500/20 to-emerald-950/30 backdrop-blur-xl rounded-3xl border border-green-300/30 p-7 shadow-[0_0_35px_rgba(34,197,94,0.20)]">
                <p class="text-green-100">Resolvidos</p>
                <p class="counter text-5xl font-bold text-green-300 mt-2" data-target="{{ $myResolvedTickets ?? 0 }}">0</p>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="{{ route('tickets.create') }}"
               class="action-btn glass-card block bg-white/10 border border-white/10 rounded-3xl p-6 backdrop-blur-xl transition">

                <p class="text-green-200">
                    Novo atendimento
                </p>

                <h2 class="text-3xl font-bold text-white mt-2">
                    Abrir chamado
                </h2>

                <p class="text-blue-100 mt-3">
                    Informe seu problema para que a equipe de suporte possa analisar e acompanhar.
                </p>

            </a>

            <a href="{{ route('tickets.index') }}"
               class="action-btn glass-card block bg-white/10 border border-white/10 rounded-3xl p-6 backdrop-blur-xl transition">

                <p class="text-blue-200">
                    Minhas solicitações
                </p>

                <h2 class="text-3xl font-bold text-white mt-2">
                    Acompanhar chamados
                </h2>

                <p class="text-blue-100 mt-3">
                    Veja o andamento, status e histórico dos chamados que você abriu.
                </p>

            </a>

        </div>

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl p-6">

            <h2 class="text-2xl font-bold text-white mb-6">
                Como funciona o atendimento
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-blue-300 text-3xl font-bold">01</div>
                    <h3 class="text-white font-bold mt-3">Você relata</h3>
                    <p class="text-blue-100 mt-2 text-sm">
                        Descreva o problema com o máximo de detalhes possível.
                    </p>
                </div>

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-purple-300 text-3xl font-bold">02</div>
                    <h3 class="text-white font-bold mt-3">Chamado aberto</h3>
                    <p class="text-blue-100 mt-2 text-sm">
                        Sua solicitação é registrada e enviada para análise.
                    </p>
                </div>

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-yellow-300 text-3xl font-bold">03</div>
                    <h3 class="text-white font-bold mt-3">Equipe acompanha</h3>
                    <p class="text-blue-100 mt-2 text-sm">
                        O suporte avalia, comenta e atualiza o andamento.
                    </p>
                </div>

                <div class="flow-step bg-white/10 border border-white/10 rounded-2xl p-5">
                    <div class="text-green-300 text-3xl font-bold">04</div>
                    <h3 class="text-white font-bold mt-3">Solução registrada</h3>
                    <p class="text-blue-100 mt-2 text-sm">
                        O chamado é resolvido e você pode consultar o histórico.
                    </p>
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

            const hour = new Date().getHours();

            if (greeting) {
                if (hour < 12) {
                    greeting.innerText = 'Bom dia,';
                } else if (hour < 18) {
                    greeting.innerText = 'Boa tarde,';
                } else {
                    greeting.innerText = 'Boa noite,';
                }
            }

            cards.forEach(function (card) {
                card.addEventListener('mousemove', function (event) {
                    const rect = card.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    card.style.background = 'radial-gradient(circle at ' + x + 'px ' + y + 'px, rgba(255,255,255,0.18), transparent 35%), linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02))';
                });

                card.addEventListener('mouseleave', function () {
                    card.style.background = '';
                });
            });

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

            counters.forEach(function (counter) {
                const target = Number(counter.dataset.target || 0);
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