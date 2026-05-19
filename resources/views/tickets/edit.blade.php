<x-app-layout>

    <div class="space-y-8">

        <div class="flex items-center gap-5">

            <div class="w-16 h-16 rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_30px_rgba(59,130,246,.40)] flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
            </div>

            <div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">
                    Editar Chamado
                </h1>

                <p class="text-blue-100 mt-2 text-lg">
                    Atualize as informações, prioridade e status do atendimento.
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

                <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,.35)]">
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Dados do chamado
                </h2>

            </div>

            <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="p-6">

                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <div>
                        <label class="block font-semibold text-blue-100 mb-2">
                            Categoria
                        </label>

                        <select
                            name="category_id"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">

                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    class="text-slate-900"
                                    {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        <p class="text-sm text-blue-200 mt-2">
                            Escolha a categoria que melhor representa o problema relatado.
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-blue-100 mb-2">
                            Título do problema
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $ticket->title) }}"
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-blue-200 rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-blue-100 mb-2">
                            Descrição detalhada
                        </label>

                        <textarea
                            name="description"
                            rows="6"
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-blue-200 rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">{{ old('description', $ticket->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block font-semibold text-blue-100 mb-2">
                                Prioridade
                            </label>

                            <select
                                name="priority"
                                id="prioritySelect"
                                class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">

                                <option value="Baixa" class="text-slate-900" {{ $ticket->priority == 'Baixa' ? 'selected' : '' }}>
                                    Baixa
                                </option>

                                <option value="Média" class="text-slate-900" {{ $ticket->priority == 'Média' ? 'selected' : '' }}>
                                    Média
                                </option>

                                <option value="Alta" class="text-slate-900" {{ $ticket->priority == 'Alta' ? 'selected' : '' }}>
                                    Alta
                                </option>

                                <option value="Urgente" class="text-slate-900" {{ $ticket->priority == 'Urgente' ? 'selected' : '' }}>
                                    Urgente
                                </option>

                            </select>

                            <p id="priorityHelp" class="text-sm text-blue-200 mt-2">
                                A prioridade deve ser definida pela equipe responsável.
                            </p>
                        </div>

                        <div>
                            <label class="block font-semibold text-blue-100 mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                id="statusSelect"
                                class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">

                                <option value="Aberto" class="text-slate-900" {{ $ticket->status == 'Aberto' ? 'selected' : '' }}>
                                    Aberto
                                </option>

                                <option value="Em andamento" class="text-slate-900" {{ $ticket->status == 'Em andamento' ? 'selected' : '' }}>
                                    Em andamento
                                </option>

                                <option value="Resolvido" class="text-slate-900" {{ $ticket->status == 'Resolvido' ? 'selected' : '' }}>
                                    Resolvido
                                </option>

                                <option value="Cancelado" class="text-slate-900" {{ $ticket->status == 'Cancelado' ? 'selected' : '' }}>
                                    Cancelado
                                </option>

                            </select>

                            <p id="statusHelp" class="text-sm text-blue-200 mt-2">
                                Atualize o status conforme o andamento do atendimento.
                            </p>
                        </div>

                    </div>

                    <div id="alertBox" class="hidden bg-yellow-500/10 border border-yellow-300/20 rounded-2xl p-5">

                        <p id="alertText" class="text-yellow-100 leading-relaxed">
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">

                        <button
                            type="submit"
                            class="action-btn bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(59,130,246,.35)] transition">
                            Atualizar Chamado
                        </button>

                        <a href="{{ route('tickets.show', $ticket) }}"
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
            const prioritySelect = document.getElementById('prioritySelect');
            const statusSelect = document.getElementById('statusSelect');
            const alertBox = document.getElementById('alertBox');
            const alertText = document.getElementById('alertText');
            const priorityHelp = document.getElementById('priorityHelp');
            const statusHelp = document.getElementById('statusHelp');

            const priorityMessages = {
                "Baixa": "Prioridade baixa: problema sem impacto imediato no trabalho.",
                "Média": "Prioridade média: problema importante, mas sem paralisação total.",
                "Alta": "Prioridade alta: problema que prejudica diretamente a execução das atividades.",
                "Urgente": "Prioridade urgente: problema crítico, com impacto alto ou paralisação do trabalho."
            };

            const statusMessages = {
                "Aberto": "Status aberto: chamado registrado e aguardando análise.",
                "Em andamento": "Status em andamento: a equipe já iniciou o atendimento.",
                "Resolvido": "Status resolvido: o problema foi tratado e o chamado pode ser encerrado.",
                "Cancelado": "Status cancelado: o chamado não será mais tratado."
            };

            function updateHelpBox() {
                const priority = prioritySelect.value;
                const status = statusSelect.value;

                priorityHelp.innerText = priorityMessages[priority] ?? 'A prioridade deve ser definida pela equipe responsável.';
                statusHelp.innerText = statusMessages[status] ?? 'Atualize o status conforme o andamento do atendimento.';

                if (priority === 'Urgente') {
                    alertBox.classList.remove('hidden');
                    alertText.innerText = 'Atenção: chamados urgentes devem representar situações críticas ou que impedem o trabalho.';
                } else if (status === 'Resolvido') {
                    alertBox.classList.remove('hidden');
                    alertText.innerText = 'Ao marcar como resolvido, confirme se a solução já foi registrada no histórico do chamado.';
                } else {
                    alertBox.classList.add('hidden');
                    alertText.innerText = '';
                }
            }

            // Atualiza mensagens de ajuda
            prioritySelect.addEventListener('change', updateHelpBox);
            statusSelect.addEventListener('change', updateHelpBox);
            updateHelpBox();

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