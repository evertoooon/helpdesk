<x-app-layout>

    <div
        class="space-y-8"
        id="ticketPage"
        data-comments-count="{{ $ticket->comments->count() }}"
        data-live-url="{{ route('tickets.comments.live', $ticket) }}">

        <div class="flex items-center gap-5">
            <div class="w-16 h-16 rounded-3xl bg-green-500/20 border border-green-300/30 flex items-center justify-center">
                🛠
            </div>

            <div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-green-300 via-white to-blue-300 bg-clip-text text-transparent">
                    Atender Chamado
                </h1>

                <p class="text-blue-100 mt-2">
                    Área administrativa do atendimento
                </p>
            </div>
        </div>

        <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">
            <h2 class="text-2xl text-white font-bold mb-5">
                Informações enviadas pelo usuário
            </h2>

            <div class="space-y-4">
                <div>
                    <label class="text-blue-200">Título</label>

                    <div class="text-white text-xl break-words">
                        {{ $ticket->title }}
                    </div>
                </div>

                <div>
                    <label class="text-blue-200">Descrição</label>

                    <div class="text-white whitespace-pre-line break-words">
                        {{ $ticket->description }}
                    </div>
                </div>

                @if($ticket->attachment)
                    <div>
                        <label class="text-blue-200">Imagem enviada</label>

                        <a
                            href="{{ asset('storage/' . $ticket->attachment) }}"
                            target="_blank"
                            rel="noopener noreferrer">

                            <img
                                src="{{ asset('storage/' . $ticket->attachment) }}"
                                alt="Imagem anexada ao chamado"
                                class="mt-3 rounded-3xl w-full max-w-md border border-white/10">
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">
            <form method="POST" action="{{ route('tickets.updateAttendance', $ticket) }}">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <div>
                        <label class="block text-blue-100 mb-2">
                            Responsável
                        </label>

                        <select
                            name="assigned_to"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4">

                            <option value="" class="text-slate-900">
                                Não atribuído
                            </option>

                            @foreach($users as $user)
                                <option
                                    value="{{ $user->id }}"
                                    class="text-slate-900"
                                    {{ old('assigned_to', $ticket->assigned_to) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('assigned_to')
                            <p class="text-red-300 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-blue-100 mb-2">
                                Prioridade
                            </label>

                            <select
                                name="priority"
                                class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4">

                                @foreach([
                                    \App\Models\Ticket::PRIORITY_BAIXA,
                                    \App\Models\Ticket::PRIORITY_MEDIA,
                                    \App\Models\Ticket::PRIORITY_ALTA,
                                    \App\Models\Ticket::PRIORITY_URGENTE,
                                ] as $priority)
                                    <option
                                        value="{{ $priority }}"
                                        class="text-black"
                                        {{ old('priority', $ticket->priority) === $priority ? 'selected' : '' }}>
                                        {{ $priority }}
                                    </option>
                                @endforeach
                            </select>

                            @error('priority')
                                <p class="text-red-300 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-blue-100 mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4">

                                @foreach([
                                    \App\Models\Ticket::STATUS_ABERTO,
                                    \App\Models\Ticket::STATUS_EM_ANDAMENTO,
                                    \App\Models\Ticket::STATUS_RESOLVIDO,
                                    \App\Models\Ticket::STATUS_CANCELADO,
                                ] as $status)
                                    <option
                                        value="{{ $status }}"
                                        class="text-black"
                                        {{ old('status', $ticket->status) === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <p class="text-red-300 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                            <h2 class="text-xl font-bold text-white">
                                💬 Conversa do chamado
                            </h2>

                            <span class="text-xs text-blue-200 bg-white/10 border border-white/10 rounded-full px-3 py-1 w-fit">
                                Atualiza automaticamente a cada 5s
                            </span>
                        </div>

                        <div id="commentsContainer" class="space-y-5">
                            @forelse($ticket->comments->sortBy('created_at') as $comment)
                                @php
                                    $isAdmin = $comment->user?->isAdmin() ?? false;
                                @endphp

                                <div class="flex {{ $isAdmin ? 'justify-end' : 'justify-start' }}">
                                    <div class="
                                        max-w-2xl
                                        rounded-3xl
                                        p-5
                                        border
                                        {{ $isAdmin
                                            ? 'bg-green-500/20 border-green-300/20 text-green-50'
                                            : 'bg-blue-500/20 border-blue-300/20 text-blue-50'
                                        }}">

                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                                            <div>
                                                <strong class="text-white">
                                                    {{ $comment->user?->name ?? 'Usuário removido' }}
                                                </strong>

                                                <span class="ml-2 text-xs px-3 py-1 rounded-full
                                                    {{ $isAdmin
                                                        ? 'bg-green-400/20 text-green-100'
                                                        : 'bg-blue-400/20 text-blue-100'
                                                    }}">
                                                    {{ $isAdmin ? 'Equipe de suporte' : 'Solicitante' }}
                                                </span>
                                            </div>

                                            <span class="text-xs text-slate-300 whitespace-nowrap">
                                                {{ $comment->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>

                                        <p class="leading-7 whitespace-pre-line break-words">
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-slate-300">
                                    Nenhum comentário encontrado.
                                </p>
                            @endforelse
                        </div>

                        @if(!$ticket->isClosed())
                            <div class="mt-6 border-t border-white/10 pt-6">
                                <label class="block text-blue-100 mb-2">
                                    Mensagem para usuário
                                </label>

                                <textarea
                                    name="comment"
                                    rows="4"
                                    maxlength="2000"
                                    placeholder="Digite uma mensagem para o usuário..."
                                    class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 placeholder-blue-200 focus:border-blue-300 focus:ring-blue-300">{{ old('comment') }}</textarea>

                                @error('comment')
                                    <p class="text-red-300 text-sm mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                                <div class="flex justify-end mt-4">
                                    <button
                                        type="submit"
                                        name="action"
                                        value="send_message"
                                        class="bg-blue-600 hover:bg-blue-500 px-7 py-4 rounded-2xl text-white font-bold transition shadow-[0_0_20px_rgba(59,130,246,.35)]">

                                        💬 Enviar mensagem
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="mt-6 bg-yellow-500/10 border border-yellow-300/20 text-yellow-100 rounded-2xl p-5">
                                Este chamado está <strong>{{ $ticket->status }}</strong>. O envio de novas mensagens está desativado.
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button
                            type="submit"
                            name="action"
                            value="save_attendance"
                            class="bg-green-600 hover:bg-green-500 px-7 py-4 rounded-2xl text-white font-bold transition">

                            💾 Salvar atendimento
                        </button>

                        <a
                            href="{{ route('tickets.show', $ticket) }}"
                            class="bg-white/10 hover:bg-white/20 px-7 py-4 rounded-2xl text-white border border-white/10 transition">

                            Voltar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ticketPage = document.getElementById('ticketPage');
            const commentsContainer = document.getElementById('commentsContainer');

            if (!ticketPage || !commentsContainer) {
                return;
            }

            const liveUrl = ticketPage.dataset.liveUrl;
            let currentCommentsCount = Number(ticketPage.dataset.commentsCount || 0);
            let isUpdating = false;

            function createElement(tag, className = '', text = '') {
                const element = document.createElement(tag);

                if (className) {
                    element.className = className;
                }

                if (text !== '') {
                    element.textContent = text;
                }

                return element;
            }

            function playNotificationSound() {
                try {
                    const audio = new Audio('https://actions.google.com/sounds/v1/alarms/notification.ogg');
                    audio.play().catch(function () {});
                } catch (error) {}
            }

            function renderEmptyComments() {
                commentsContainer.innerHTML = '';

                commentsContainer.appendChild(
                    createElement(
                        'p',
                        'text-slate-300',
                        'Nenhum comentário encontrado.'
                    )
                );
            }

            function renderComments(comments) {
                commentsContainer.innerHTML = '';

                if (!Array.isArray(comments) || comments.length === 0) {
                    renderEmptyComments();
                    return;
                }

                comments.forEach(function (comment) {
                    const user = comment.user || {};
                    const isAdmin = user.role === 'admin';

                    const wrapper = createElement(
                        'div',
                        isAdmin ? 'flex justify-end' : 'flex justify-start'
                    );

                    const bubble = createElement(
                        'div',
                        isAdmin
                            ? 'max-w-2xl rounded-3xl p-5 border bg-green-500/20 border-green-300/20 text-green-50'
                            : 'max-w-2xl rounded-3xl p-5 border bg-blue-500/20 border-blue-300/20 text-blue-50'
                    );

                    const header = createElement(
                        'div',
                        'flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2'
                    );

                    const userBox = createElement('div');

                    const userName = createElement(
                        'strong',
                        'text-white',
                        user.name || 'Usuário removido'
                    );

                    const roleBadge = createElement(
                        'span',
                        isAdmin
                            ? 'ml-2 text-xs px-3 py-1 rounded-full bg-green-400/20 text-green-100'
                            : 'ml-2 text-xs px-3 py-1 rounded-full bg-blue-400/20 text-blue-100',
                        isAdmin ? 'Equipe de suporte' : 'Solicitante'
                    );

                    const createdAt = createElement(
                        'span',
                        'text-xs text-slate-300 whitespace-nowrap',
                        comment.created_at_formatted || ''
                    );

                    const text = createElement(
                        'p',
                        'leading-7 whitespace-pre-line break-words',
                        comment.comment || ''
                    );

                    userBox.appendChild(userName);
                    userBox.appendChild(roleBadge);

                    header.appendChild(userBox);
                    header.appendChild(createdAt);

                    bubble.appendChild(header);
                    bubble.appendChild(text);

                    wrapper.appendChild(bubble);
                    commentsContainer.appendChild(wrapper);
                });
            }

            function userIsTyping() {
                const activeElement = document.activeElement;

                return activeElement && (
                    activeElement.tagName === 'TEXTAREA' ||
                    activeElement.tagName === 'INPUT' ||
                    activeElement.tagName === 'SELECT'
                );
            }

            function updateComments() {
                if (userIsTyping() || !liveUrl || isUpdating) {
                    return;
                }

                isUpdating = true;

                fetch(liveUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Erro ao buscar comentários.');
                        }

                        return response.json();
                    })
                    .then(function (data) {
                        const newCount = Number(data.count || 0);

                        if (newCount !== currentCommentsCount) {
                            if (newCount > currentCommentsCount) {
                                playNotificationSound();
                            }

                            currentCommentsCount = newCount;
                            ticketPage.dataset.commentsCount = String(currentCommentsCount);

                            renderComments(data.comments || []);
                        }
                    })
                    .catch(function () {
                        console.log('Erro ao atualizar chat.');
                    })
                    .finally(function () {
                        isUpdating = false;
                    });
            }

            setInterval(updateComments, 5000);
        });
    </script>

</x-app-layout>