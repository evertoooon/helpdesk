<x-app-layout>

    <div class="space-y-8" id="ticketPage" data-comments-count="{{ $ticket->comments->count() }}">

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
                    <label class="text-blue-200">
                        Título
                    </label>

                    <div class="text-white text-xl">
                        {{ $ticket->title }}
                    </div>
                </div>


                <div>
                    <label class="text-blue-200">
                        Descrição
                    </label>

                    <div class="text-white">
                        {{ $ticket->description }}
                    </div>
                </div>


                @if($ticket->attachment)

                <div>
                    <label class="text-blue-200">
                        Imagem enviada
                    </label>

                    <a href="{{ asset('storage/'.$ticket->attachment) }}" target="_blank">

                        <img
                            src="{{ asset('storage/'.$ticket->attachment) }}"
                            class="mt-3 rounded-3xl max-w-md border border-white/10">

                    </a>
                </div>

                @endif

            </div>

        </div>



        <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">

            <form method="POST" action="{{ route('tickets.updateAttendance',$ticket) }}">

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
                                {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="grid md:grid-cols-2 gap-6">

                        <div>

                            <label class="block text-blue-100 mb-2">
                                Prioridade
                            </label>

                            <select
                                name="priority"
                                class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4">

                                <option value="Baixa" class="text-black" {{ $ticket->priority == 'Baixa' ? 'selected' : '' }}>
                                    Baixa
                                </option>

                                <option value="Média" class="text-black" {{ $ticket->priority == 'Média' ? 'selected' : '' }}>
                                    Média
                                </option>

                                <option value="Alta" class="text-black" {{ $ticket->priority == 'Alta' ? 'selected' : '' }}>
                                    Alta
                                </option>

                                <option value="Urgente" class="text-black" {{ $ticket->priority == 'Urgente' ? 'selected' : '' }}>
                                    Urgente
                                </option>

                            </select>

                        </div>


                        <div>

                            <label class="block text-blue-100 mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4">

                                <option value="Aberto" class="text-black" {{ $ticket->status == 'Aberto' ? 'selected' : '' }}>
                                    Aberto
                                </option>

                                <option value="Em andamento" class="text-black" {{ $ticket->status == 'Em andamento' ? 'selected' : '' }}>
                                    Em andamento
                                </option>

                                <option value="Resolvido" class="text-black" {{ $ticket->status == 'Resolvido' ? 'selected' : '' }}>
                                    Resolvido
                                </option>

                                <option value="Cancelado" class="text-black" {{ $ticket->status == 'Cancelado' ? 'selected' : '' }}>
                                    Cancelado
                                </option>

                            </select>

                        </div>

                    </div>


                    @if(!in_array($ticket->status, ['Resolvido', 'Cancelado']))

                    <div>

                        <label class="block text-blue-100 mb-2">
                            Mensagem para usuário
                        </label>

                        <textarea
                            name="comment"
                            rows="5"
                            placeholder="Ex: Testa agora a internet e me avisa."
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 placeholder-blue-200 focus:border-blue-300 focus:ring-blue-300"></textarea>

                        @error('comment')
                        <p class="text-red-300 text-sm mt-2">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    @else

                    <div class="bg-yellow-500/10 border border-yellow-300/20 text-yellow-100 rounded-2xl p-5">
                        Este chamado está <strong>{{ $ticket->status }}</strong>. O envio de novas mensagens está desativado.
                    </div>

                    @endif



                    <!-- Conversa do chamado -->

                    <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 p-6">

                        <div class="flex items-center justify-between mb-6">

                            <h2 class="text-xl font-bold text-white">
                                💬 Conversa do chamado
                            </h2>

                            <span class="text-xs text-blue-200 bg-white/10 border border-white/10 rounded-full px-3 py-1">
                                Atualiza automaticamente a cada 20s
                            </span>

                        </div>

                        <div class="space-y-5">

                            @forelse($ticket->comments->sortBy('created_at') as $comment)

                            @php
                            $isAdmin = $comment->user->role === 'admin';
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

                                    <div class="flex items-center justify-between gap-6 mb-2">

                                        <div>

                                            <strong class="text-white">
                                                {{ $comment->user->name }}
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

                                    <p class="leading-7">
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

                    </div>


                    <div class="flex flex-wrap gap-3">

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-500 px-7 py-4 rounded-2xl text-white font-bold transition">

                            Salvar atendimento

                        </button>

                        <a
                            href="{{ route('tickets.show',$ticket) }}"
                            class="bg-white/10 hover:bg-white/20 px-7 py-4 rounded-2xl text-white border border-white/10 transition">

                            Voltar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const ticketPage =
                document.getElementById(
                    'ticketPage'
                );

            const ticketId =
                "{{ $ticket->id }}";

            let currentCommentsCount =
                Number(
                    ticketPage.dataset.commentsCount
                );


            function playNotificationSound() {

                try {

                    const audio =
                        new Audio(
                            'https://actions.google.com/sounds/v1/alarms/notification.ogg'
                        );

                    audio.play();

                } catch (e) {}

            }


            function renderComments(
                comments
            ) {

                let html = '';

                comments.forEach(comment => {

                    const isAdmin =
                        comment.user.role ===
                        'admin';

                    html += `

            <div class="flex
            ${isAdmin
            ?'justify-end'
            :'justify-start'}">

                <div class="
                max-w-2xl
                rounded-3xl
                p-5
                border
                ${isAdmin
                ?'bg-green-500/20 border-green-300/20 text-green-50'
                :'bg-blue-500/20 border-blue-300/20 text-blue-50'}">

                    <div class="flex
                    items-center
                    justify-between
                    gap-6
                    mb-2">

                        <div>

                        <strong
                        class="text-white">

                        ${comment.user.name}

                        </strong>

                        <span class="ml-2
                        text-xs">

                        ${
                        isAdmin
                        ?'Equipe de suporte'
                        :'Solicitante'
                        }

                        </span>

                        </div>

                    </div>

                    <p class="leading-7">

                    ${comment.comment}

                    </p>

                </div>

            </div>

            `;

                });

                document.querySelector(
                    '.space-y-5'
                ).innerHTML = html;

            }


            setInterval(function() {

                const activeElement =
                    document.activeElement;

                const isTyping =

                    activeElement && (

                        activeElement.tagName ===
                        'TEXTAREA'

                        ||

                        activeElement.tagName ===
                        'INPUT'

                        ||

                        activeElement.tagName ===
                        'SELECT'

                    );


                if (isTyping) {

                    return;

                }


                fetch(

                        `/tickets/${ticketId}/comments/live`

                    )

                    .then(

                        response =>
                        response.json()

                    )

                    .then(data => {

                        if (
                            data.count >
                            currentCommentsCount
                        ) {

                            currentCommentsCount =
                                data.count;

                            playNotificationSound();

                            renderComments(
                                data.comments
                            );

                        }

                    })

                    .catch(() => {

                        console.log(
                            'Erro ao atualizar chat'
                        );

                    });

            }, 5000);

        });
    </script>

</x-app-layout>