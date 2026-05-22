<x-guest-layout>

    <div class="w-full max-w-xl mx-auto">

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-[32px] border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-8 border-b border-white/10 text-center">

                <div class="w-20 h-20 mx-auto rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_35px_rgba(59,130,246,.45)] flex items-center justify-center mb-5">

                    <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.105 0 2-.895 2-2V7a2 2 0 1 0-4 0v2c0 1.105.895 2 2 2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 11h14v9H5z"/>
                    </svg>

                </div>

                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">
                    Recuperar senha
                </h1>

                <p class="text-blue-100 mt-3 leading-relaxed">
                    Informe seu e-mail cadastrado e enviaremos um link para redefinir sua senha.
                </p>

            </div>

            <div class="p-8">

                <x-auth-session-status class="mb-4 text-green-200" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">

                    @csrf

                    <div>

                        <label for="email" class="block text-blue-100 font-semibold mb-2">
                            E-mail
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="Digite seu e-mail"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 placeholder-blue-200 focus:border-blue-300 focus:ring-blue-300">

                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />

                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(37,99,235,.45)] transition hover:scale-[1.02]">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7l8 6 8-6"/>
                        </svg>

                        Enviar link de recuperação

                    </button>

                </form>

                <div class="mt-6 text-center">

                    <a href="{{ route('login') }}"
                       class="text-blue-200 hover:text-white transition font-semibold">
                        ← Voltar para o login
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>