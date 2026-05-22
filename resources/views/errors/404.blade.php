<x-app-layout>

    <div class="min-h-[70vh] flex items-center justify-center">

        <div class="max-w-2xl w-full
        bg-gradient-to-br
        from-blue-500/10
        to-purple-500/10
        backdrop-blur-xl
        border border-blue-300/20
        rounded-[35px]
        p-12
        text-center
        shadow-[0_0_50px_rgba(59,130,246,.15)]">

            <div class="
            w-28 h-28
            mx-auto
            rounded-full
            bg-blue-500/15
            border border-blue-300/20
            flex items-center justify-center
            text-5xl
            shadow-[0_0_35px_rgba(59,130,246,.25)]">

                🔍

            </div>

            <h1 class="mt-8
            text-6xl
            font-black
            text-white">

                404

            </h1>

            <h2 class="mt-4
            text-3xl
            font-bold
            text-blue-200">

                Página não encontrada

            </h2>

            <p class="mt-6
            text-lg
            text-blue-100
            leading-8">

                A página que você tentou acessar não existe ou foi removida do sistema.

            </p>

            <div class="mt-10 flex justify-center gap-4">

                <a href="{{ route('dashboard') }}"
                class="inline-flex
                items-center
                gap-3
                px-8
                py-4
                rounded-2xl
                bg-blue-500/20
                hover:bg-blue-500/30
                border border-blue-300/20
                text-white
                font-bold
                transition-all">

                    🏠 Dashboard

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

                    ← Voltar

                </a>

            </div>

        </div>

    </div>

</x-app-layout>