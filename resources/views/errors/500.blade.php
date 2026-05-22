<x-app-layout>

    <div class="min-h-[70vh] flex items-center justify-center">

        <div class="max-w-2xl w-full
        bg-gradient-to-br
        from-red-500/10
        to-pink-500/10
        backdrop-blur-xl
        border border-red-300/20
        rounded-[35px]
        p-12
        text-center
        shadow-[0_0_50px_rgba(239,68,68,.15)]">

            <div class="
            w-28 h-28
            mx-auto
            rounded-full
            bg-red-500/15
            border border-red-300/20
            flex items-center justify-center
            text-5xl
            shadow-[0_0_35px_rgba(239,68,68,.25)]">

                ⚠️

            </div>

            <h1 class="mt-8
            text-6xl
            font-black
            text-white">

                500

            </h1>

            <h2 class="mt-4
            text-3xl
            font-bold
            text-red-200">

                Erro interno do sistema

            </h2>

            <p class="mt-6
            text-lg
            text-blue-100
            leading-8">

                Ocorreu um erro inesperado durante o processamento da solicitação.
                Nossa equipe foi notificada e está trabalhando para resolver o problema.

            </p>

            <div class="mt-10 flex justify-center gap-4">

                <a href="{{ route('dashboard') }}"
                class="inline-flex
                items-center
                gap-3
                px-8
                py-4
                rounded-2xl
                bg-red-500/20
                hover:bg-red-500/30
                border border-red-300/20
                text-white
                font-bold
                transition-all">

                    🏠 Voltar ao Dashboard

                </a>

                <a href="{{ url()->previous() }}"
                class="inline-flex
                items-center
                gap-3
                px-8
                py-4
                rounded-2xl
                bg-white/10
                hover:bg-white/20
                border border-white/10
                text-white
                font-bold
                transition-all">

                    ← Página anterior

                </a>

            </div>

        </div>

    </div>

</x-app-layout>