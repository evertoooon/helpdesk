<x-app-layout>

    <div class="space-y-8">

        <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-2xl shadow-lg p-8 text-white">

            <h1 class="text-3xl font-bold mb-2">
                Bem-vindo ao HelpDesk 👋
            </h1>

            <p class="text-blue-100 text-lg">
                Gerencie chamados, acompanhe solicitações e organize o suporte de forma simples e eficiente.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
                <p class="text-sm text-slate-500 mb-2">
                    Categorias
                </p>

                <h2 class="text-3xl font-bold text-slate-800">
                    Organize
                </h2>

                <p class="text-slate-600 mt-2">
                    Cadastre tipos de problemas para orientar melhor os usuários.
                </p>

                <a href="{{ route('categories.index') }}"
                   class="inline-block mt-4 text-blue-600 font-semibold hover:underline">
                    Ver categorias
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
                <p class="text-sm text-slate-500 mb-2">
                    Chamados
                </p>

                <h2 class="text-3xl font-bold text-slate-800">
                    Acompanhe
                </h2>

                <p class="text-slate-600 mt-2">
                    Visualize solicitações abertas, em andamento e resolvidas.
                </p>

                <a href="{{ route('tickets.index') }}"
                   class="inline-block mt-4 text-blue-600 font-semibold hover:underline">
                    Ver chamados
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
                <p class="text-sm text-slate-500 mb-2">
                    Atendimento
                </p>

                <h2 class="text-3xl font-bold text-slate-800">
                    Resolva
                </h2>

                <p class="text-slate-600 mt-2">
                    Use o histórico dos chamados para registrar atualizações e soluções.
                </p>

                <a href="{{ route('tickets.create') }}"
                   class="inline-block mt-4 text-blue-600 font-semibold hover:underline">
                    Abrir chamado
                </a>
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">

            <h2 class="text-xl font-bold text-slate-800 mb-4">
                Fluxo do sistema
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-2xl mb-2">1️⃣</div>
                    <h3 class="font-semibold text-slate-800">Usuário relata</h3>
                    <p class="text-sm text-slate-600 mt-1">
                        O usuário descreve o problema com detalhes.
                    </p>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-2xl mb-2">2️⃣</div>
                    <h3 class="font-semibold text-slate-800">Chamado é registrado</h3>
                    <p class="text-sm text-slate-600 mt-1">
                        O sistema salva categoria, descrição e status inicial.
                    </p>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-2xl mb-2">3️⃣</div>
                    <h3 class="font-semibold text-slate-800">Equipe acompanha</h3>
                    <p class="text-sm text-slate-600 mt-1">
                        Atualizações são registradas no histórico do chamado.
                    </p>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-2xl mb-2">4️⃣</div>
                    <h3 class="font-semibold text-slate-800">Problema resolvido</h3>
                    <p class="text-sm text-slate-600 mt-1">
                        O chamado é finalizado com registro da solução.
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>