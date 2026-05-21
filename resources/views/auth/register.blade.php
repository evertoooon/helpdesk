<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-md">

            <div class="text-center mb-8">

                <div class="mx-auto relative w-24 h-24 mb-5">

                    <div class="absolute inset-0 rounded-full blur-xl bg-purple-500/60"></div>

                    <div class="relative w-24 h-24 rounded-full bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 p-[3px] shadow-[0_0_35px_rgba(100,120,255,.75)]">

                        <div class="w-full h-full rounded-full bg-[#081225] flex items-center justify-center relative">

                            <div class="absolute top-2 left-1/2 w-[2px] h-5 bg-cyan-300"></div>
                            <div class="absolute bottom-2 left-1/2 w-[2px] h-5 bg-purple-300"></div>
                            <div class="absolute left-2 top-1/2 h-[2px] w-5 bg-cyan-300"></div>
                            <div class="absolute right-2 top-1/2 h-[2px] w-5 bg-purple-300"></div>

                            <div class="px-4 py-2 rounded-lg border-2 border-cyan-300 bg-blue-500/20 text-white font-bold text-xl shadow-[0_0_18px_rgba(56,189,248,.65)]">
                                HD
                            </div>

                        </div>

                    </div>

                </div>

                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">
                    HelpDesk
                </h1>

                <p class="text-blue-100 mt-3">
                    Crie sua conta para acessar o sistema.
                </p>

            </div>

            <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

                <div class="p-6 border-b border-white/10">

                    <h2 class="text-2xl font-bold text-white">
                        Criar conta
                    </h2>

                    <p class="text-blue-200 text-sm mt-1">
                        Preencha os dados abaixo.
                    </p>

                </div>

                <form method="POST"
                      action="{{ route('register') }}"
                      class="p-6 space-y-6">

                    @csrf

                    <div>

                        <label for="name"
                               class="block text-blue-100 mb-2 font-medium">

                            Nome

                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Digite seu nome"

                            class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                            placeholder:text-blue-200/50
                            focus:border-blue-400
                            focus:ring focus:ring-blue-500/20
                            transition">

                        @error('name')
                            <p class="text-red-300 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div>

                        <label for="email"
                               class="block text-blue-100 mb-2 font-medium">

                            E-mail

                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="Digite seu e-mail"

                            class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                            placeholder:text-blue-200/50
                            focus:border-blue-400
                            focus:ring focus:ring-blue-500/20
                            transition">

                        @error('email')
                            <p class="text-red-300 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div>

                        <label for="password"
                               class="block text-blue-100 mb-2 font-medium">

                            Senha

                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Digite sua senha"

                            class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                            placeholder:text-blue-200/50
                            focus:border-purple-400
                            focus:ring focus:ring-purple-500/20
                            transition">

                        @error('password')
                            <p class="text-red-300 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div>

                        <label for="password_confirmation"
                               class="block text-blue-100 mb-2 font-medium">

                            Confirmar senha

                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirme sua senha"

                            class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                            placeholder:text-blue-200/50
                            focus:border-purple-400
                            focus:ring focus:ring-purple-500/20
                            transition">

                        @error('password_confirmation')
                            <p class="text-red-300 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <button
                        type="submit"

                        class="w-full px-7 py-4 rounded-2xl
                        bg-gradient-to-r from-blue-600 to-purple-600
                        hover:from-blue-500 hover:to-purple-500
                        hover:scale-[1.02]
                        transition
                        text-white
                        font-bold
                        shadow-[0_0_30px_rgba(99,102,241,.35)]">

                        Criar conta

                    </button>

                    <p class="text-center text-blue-100 text-sm">

                        Já possui uma conta?

                        <a href="{{ route('login') }}"
                           class="text-blue-300 hover:text-white font-semibold transition">

                            Entrar

                        </a>

                    </p>

                </form>

            </div>

        </div>

    </div>

</x-guest-layout>