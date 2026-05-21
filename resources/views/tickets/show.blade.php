<x-app-layout>

<div class="space-y-8"
     id="ticketContainer"
     data-ticket-id="{{ $ticket->id }}"
     data-comments-count="{{ $ticket->comments->count() }}">

    <!-- Cabeçalho -->

    <div class="relative overflow-hidden rounded-[30px]
        border border-white/10
        bg-gradient-to-r
        from-[#1d3f8d]/80
        via-[#243b7a]/80
        to-[#48206f]/80
        backdrop-blur-xl p-8">

        <div class="flex items-center gap-5">

            <div class="w-20 h-20 rounded-3xl
            bg-blue-500/20 border border-blue-400/20
            flex items-center justify-center">

                🎫

            </div>

            <div>

                <h1 class="text-4xl font-bold text-white">
                    {{ $ticket->title }}
                </h1>

                <p class="text-blue-200 mt-2">
                    Chamado #{{ $ticket->id }}
                </p>

            </div>

        </div>

    </div>


    <div class="mt-5">

        <a href="{{ route('tickets.index') }}"
        class="inline-flex items-center gap-2
        bg-white/10 hover:bg-white/20
        text-white px-5 py-3 rounded-2xl">

            ← Voltar

        </a>

    </div>


    <!-- Chat -->

    <div class="bg-white/10
    backdrop-blur-xl
    rounded-3xl
    border border-white/10
    p-6">

        <h2 class="text-xl font-bold text-white mb-6">

            💬 Conversa do chamado

        </h2>


        <div
        id="chatArea"
        class="space-y-5">

            @foreach(
                $ticket
                ->comments
                ->sortBy('created_at')
                as $comment
            )

            @php
                $isAdmin=
                $comment
                ->user
                ->role
                ===
                'admin';
            @endphp

            <div class="
            flex
            {{ $isAdmin
            ? 'justify-end'
            : 'justify-start' }}
            ">

                <div class="
                max-w-2xl
                rounded-3xl
                p-5
                border
                {{ $isAdmin
                ? 'bg-green-500/20 border-green-300/20'
                : 'bg-blue-500/20 border-blue-300/20'
                }}">

                    <div class="mb-2">

                        <strong class="text-white">

                            {{ $comment->user->name }}

                        </strong>

                    </div>

                    <p class="text-white">

                        {{ $comment->comment }}

                    </p>

                </div>

            </div>

            @endforeach

        </div>


@if(!in_array($ticket->status,['Resolvido','Cancelado']))

<form
method="POST"
action="{{ route('tickets.comments.store',$ticket) }}"
class="mt-8">

@csrf

<textarea
name="comment"
rows="4"
placeholder="Digite uma resposta..."
class="w-full
bg-white/10
border border-white/20
text-white
rounded-2xl
p-4"></textarea>

<button
type="submit"
class="mt-4
bg-blue-600
text-white
px-6
py-3
rounded-2xl">

Enviar comentário

</button>

</form>

@else

<div class="mt-8
bg-yellow-500/10
border border-yellow-300/20
text-yellow-100
rounded-2xl
p-5">

Chamado encerrado.

</div>

@endif

    </div>

</div>


<script>

const container=
document.getElementById(
'ticketContainer'
);

const ticketId=
container.dataset.ticketId;

let currentCount=
parseInt(
container.dataset.commentsCount
);


function playNotification(){

    try{

        const audio=
        new Audio(
        'https://actions.google.com/sounds/v1/alarms/notification.ogg'
        );

        audio.play();

    }catch(e){}

}


function updateComments(){

fetch(
`/tickets/${ticketId}/comments/live`
)

.then(
response=>
response.json()
)

.then(data=>{

if(
data.count>
currentCount
){

currentCount=
data.count;

playNotification();

let html='';

data.comments.forEach(comment=>{

const isAdmin=
comment.user.role==='admin';

html +=`

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
?'bg-green-500/20 border-green-300/20'
:'bg-blue-500/20 border-blue-300/20'}">

<div class="mb-2">

<strong class="text-white">

${comment.user.name}

</strong>

</div>

<p class="text-white">

${comment.comment}

</p>

</div>

</div>

`;

});

document.getElementById(
'chatArea'
).innerHTML=html;

}

});

}

setInterval(
updateComments,
5000
);

</script>

</x-app-layout>