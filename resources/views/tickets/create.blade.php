<x-app-layout>

    <div class="space-y-8">

        <div class="flex items-center gap-5">

            <div class="w-16 h-16 rounded-3xl bg-green-500/20 border border-green-300/30 shadow-[0_0_30px_rgba(34,197,94,.40)] flex items-center justify-center">
                <svg class="w-8 h-8 text-green-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/>
                </svg>
            </div>

            <div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-green-300 via-white to-blue-300 bg-clip-text text-transparent">
                    Novo Chamado
                </h1>

                <p class="text-blue-100 mt-2 text-lg">
                    Descreva seu problema para receber suporte.
                </p>
            </div>

        </div>

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-300/30 text-red-100 p-4 rounded-2xl backdrop-blur-xl">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10 flex items-center gap-4">

                <div class="w-11 h-11 rounded-2xl bg-green-500/20 border border-green-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,.35)]">
                    <svg class="w-6 h-6 text-green-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white">
                    Abrir chamado
                </h2>

            </div>

            <form method="POST"
                  action="{{ route('tickets.store') }}"
                  enctype="multipart/form-data"
                  class="p-6">

                @csrf

                <div class="space-y-6">

                    <div>

                        <label class="block font-semibold text-blue-100 mb-2">
                            Categoria
                        </label>

                        <select
                            id="categorySelect"
                            name="category_id"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 focus:border-blue-300 focus:ring-blue-300">

                            <option value="" class="text-slate-900">
                                Selecione
                            </option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="text-slate-900">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div id="helperBox"
                         class="hidden bg-blue-500/10 border border-blue-300/20 rounded-2xl p-5">

                        <h3 class="text-white text-xl font-bold mb-3">
                            Informações úteis
                        </h3>

                        <p id="helperText"
                           class="text-blue-100 leading-relaxed">
                        </p>

                    </div>

                    <div>

                        <label class="block font-semibold text-blue-100 mb-2">
                            Título
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Ex: computador não liga"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 placeholder-blue-200 focus:border-blue-300 focus:ring-blue-300">

                    </div>

                    <div>

                        <label class="block font-semibold text-blue-100 mb-2">
                            Descrição
                        </label>

                        <textarea
                            rows="7"
                            name="description"
                            placeholder="Descreva detalhadamente o problema."
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 placeholder-blue-200 focus:border-blue-300 focus:ring-blue-300">{{ old('description') }}</textarea>

                    </div>

                    <div>

                        <label class="block font-semibold text-blue-100 mb-2">
                            Foto ou print do problema
                        </label>

                        <input
                            type="file"
                            id="attachmentInput"
                            name="attachment"
                            accept="image/*"
                            class="w-full bg-white/10 border border-white/20 text-blue-100 rounded-2xl p-4
                            file:mr-4
                            file:py-2
                            file:px-4
                            file:rounded-xl
                            file:border-0
                            file:bg-blue-600
                            file:text-white
                            hover:file:bg-blue-500">

                        <p class="text-sm text-blue-200 mt-2">
                            Opcional. Envie uma imagem, print ou foto do erro para ajudar a equipe de suporte.
                            Formatos aceitos: JPG, JPEG, PNG ou WEBP.
                        </p>

                        <div id="previewBox"
                             class="hidden mt-5 bg-white/10 border border-white/20 rounded-2xl p-4">

                            <p class="text-blue-100 font-semibold mb-3">
                                Pré-visualização da imagem:
                            </p>

                            <img
                                id="previewImage"
                                src=""
                                alt="Pré-visualização do anexo"
                                class="max-w-sm w-full rounded-2xl border border-white/20 shadow-[0_0_25px_rgba(59,130,246,.25)]">

                            <p class="text-sm text-blue-200 mt-3">
                                Confira se esta é a imagem correta antes de abrir o chamado.
                            </p>

                        </div>

                        @error('attachment')
                            <p class="text-red-300 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="bg-yellow-500/10 border border-yellow-300/20 rounded-2xl p-5">

                        <p class="text-yellow-100 leading-relaxed">
                            O chamado será registrado inicialmente como
                            <strong>Aberto</strong>
                            e com prioridade
                            <strong>Média</strong>.
                            A equipe responsável poderá ajustar a prioridade após analisar o problema.
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        <button
                            type="submit"
                            class="action-btn bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(34,197,94,.35)] transition">
                            Abrir Chamado
                        </button>

                        <a href="{{ route('tickets.index') }}"
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
            const category = document.getElementById('categorySelect');
            const helper = document.getElementById('helperBox');
            const helperText = document.getElementById('helperText');
            const buttons = document.querySelectorAll('.action-btn');

            const attachmentInput = document.getElementById('attachmentInput');
            const previewBox = document.getElementById('previewBox');
            const previewImage = document.getElementById('previewImage');

            const tips = {
                "Acesso": "Problemas comuns: senha incorreta, bloqueio de acesso ou usuário sem permissão.",
                "E-mail": "Problemas comuns: não recebe emails, erro ao enviar ou caixa cheia.",
                "Hardware": "Problemas comuns: computador lento, não liga ou defeitos físicos.",
                "Impressora": "Problemas comuns: atolamento, offline ou falha de impressão.",
                "Manutenção": "Problemas comuns: limpeza preventiva, revisão de equipamentos ou troca de componentes.",
                "Outros": "Use esta opção quando o problema não se encaixar claramente nas demais categorias.",
                "Rede": "Problemas comuns: internet lenta, queda de conexão ou dificuldade de acesso à rede.",
                "Servidor": "Problemas comuns: serviço indisponível, sistema fora do ar ou falha em infraestrutura.",
                "Sistema": "Problemas comuns: erro interno, falha inesperada, lentidão ou travamento do sistema.",
                "Software": "Problemas comuns: erros, travamentos, atualização ou instalação de programas."
            };

            category.addEventListener('change', function () {
                const selectedName = category.options[category.selectedIndex].text.trim();

                if (tips[selectedName]) {
                    helper.classList.remove('hidden');
                    helperText.innerText = tips[selectedName];
                } else {
                    helper.classList.add('hidden');
                    helperText.innerText = '';
                }
            });

            attachmentInput.addEventListener('change', function () {
                const file = attachmentInput.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (event) {
                        previewImage.src = event.target.result;
                        previewBox.classList.remove('hidden');
                    };

                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = '';
                    previewBox.classList.add('hidden');
                }
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
        });
    </script>

</x-app-layout>