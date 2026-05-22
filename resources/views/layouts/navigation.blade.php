<nav x-data="{ open: false }" class="relative z-50 py-4">

    <div class="max-w-7xl mx-auto px-6">

        <div class="
            bg-gradient-to-r
            from-[#08142d]/95
            via-[#0f1f4d]/95
            to-[#26124f]/95
            backdrop-blur-xl
            rounded-[30px]
            border border-blue-400/15
            shadow-[0_0_35px_rgba(70,90,255,.18)]
            px-8
            py-5
        ">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-14">

                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4">

                        <div class="relative">

                            <div class="absolute inset-0 rounded-full blur-xl bg-purple-500/50"></div>

                            <div class="
                                relative
                                w-16
                                h-16
                                rounded-full
                                bg-gradient-to-r
                                from-cyan-500
                                via-blue-500
                                to-purple-600
                                p-[3px]
                                shadow-[0_0_30px_rgba(110,90,255,.8)]
                            ">

                                <div class="
                                    w-full
                                    h-full
                                    rounded-full
                                    bg-[#091223]
                                    flex
                                    items-center
                                    justify-center
                                    relative
                                ">

                                    <div class="absolute top-1 left-1/2 w-[2px] h-3 bg-cyan-400"></div>
                                    <div class="absolute bottom-1 left-1/2 w-[2px] h-3 bg-purple-400"></div>
                                    <div class="absolute left-1 top-1/2 h-[2px] w-3 bg-cyan-400"></div>
                                    <div class="absolute right-1 top-1/2 h-[2px] w-3 bg-purple-400"></div>

                                    <div class="
                                        w-9
                                        h-7
                                        rounded-md
                                        bg-gradient-to-r
                                        from-blue-500/30
                                        to-purple-500/30
                                        border
                                        border-cyan-300
                                        flex
                                        items-center
                                        justify-center
                                        text-white
                                        font-bold
                                    ">
                                        HD
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-white leading-none">
                                HelpDesk
                            </h1>

                            <p class="text-sm text-blue-200">
                                Sistema de suporte
                            </p>
                        </div>

                    </a>

                    @auth

                    <div class="hidden lg:flex gap-4">

                        <a href="{{ route('dashboard') }}"
                            class="
                                    px-8
                                    py-4
                                    rounded-2xl
                                    bg-white/10
                                    border
                                    border-white/10
                                    text-white
                                    hover:bg-white/15
                                    transition
                                    duration-300
                                    shadow-[0_0_15px_rgba(60,120,255,.15)]
                               ">
                            📊 Dashboard
                        </a>

                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('categories.index') }}"
                            class="
                                        px-8
                                        py-4
                                        rounded-2xl
                                        text-blue-100
                                        hover:text-white
                                        hover:bg-white/10
                                        transition
                                   ">
                            📁 Categorias
                        </a>
                        @endif

                        <a href="{{ route('tickets.index') }}"
                            class="
                                    px-8
                                    py-4
                                    rounded-2xl
                                    text-blue-100
                                    hover:text-white
                                    hover:bg-white/10
                                    transition
                               ">
                            📋 Chamados
                        </a>

                    </div>

                    @endauth

                </div>

                @auth

                <div>

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">

                            <button class="
                                    px-6
                                    py-4
                                    rounded-2xl
                                    bg-white/10
                                    border border-white/10
                                    text-white
                                    backdrop-blur-xl
                                    hover:bg-white/20
                                    transition
                                ">
                                👤 {{ Auth::user()->name }}
                            </button>

                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                Perfil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sair
                                </button>
                            </form>

                        </x-slot>

                    </x-dropdown>

                </div>

                @else

                <div class="flex items-center gap-3">

                    <a href="{{ route('login') }}"
                        class="
                                px-6
                                py-3
                                rounded-2xl
                                bg-white/10
                                border border-white/10
                                text-white
                                hover:bg-white/20
                                transition
                           ">
                        Entrar
                    </a>

                </div>

                @endauth

            </div>

        </div>

    </div>

</nav>