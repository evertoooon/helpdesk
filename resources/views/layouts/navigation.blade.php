<nav x-data="{ open: false }"
    class="bg-white/10 backdrop-blur-xl border-b border-white/10 shadow-xl sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <div class="flex items-center">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold shadow-lg">
                        H
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-white leading-tight">
                            HelpDesk
                        </h1>

                        <p class="text-[11px] text-blue-200 leading-tight">
                            Sistema de suporte
                        </p>
                    </div>

                </a>

                <div class="hidden space-x-2 sm:flex sm:items-center sm:ms-10">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-blue-100 hover:text-white hover:bg-white/10 transition">
                        Dashboard
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="px-4 py-2 rounded-xl text-blue-100 hover:text-white hover:bg-white/10 transition">
                        Categorias
                    </a>

                    <a href="{{ route('tickets.index') }}"
                       class="px-4 py-2 rounded-xl text-blue-100 hover:text-white hover:bg-white/10 transition">
                        Chamados
                    </a>

                </div>

            </div>

            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center px-4 py-2 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/10 text-white hover:bg-white/20 transition">

                            <div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10
                                        10.586l3.293-3.293a1 1 0
                                        111.414 1.414l-4
                                        4a1 1 0
                                        01-1.414
                                        0l-4-4a1
                                        1 0
                                        010-1.414z"
                                        clip-rule="evenodd"/>
                                </svg>
                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

        </div>

    </div>

</nav>