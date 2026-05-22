<x-guest-layout>

    <div class="w-full max-w-xl mx-auto">

        <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-[32px] border border-white/15 shadow-2xl overflow-hidden">

            <div class="p-8 border-b border-white/10 text-center">

                <div class="w-20 h-20 mx-auto rounded-3xl bg-purple-500/20 border border-purple-300/30 shadow-[0_0_35px_rgba(168,85,247,.45)] flex items-center justify-center mb-5">

                    <svg class="w-10 h-10 text-purple-200" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.105 0 2-.895 2-2V7a2 2 0 1 0-4 0v2c0 1.105.895 2 2 2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 11h14v9H5z"/>
                    </svg>

                </div>

                <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-300 via-white to-blue-300 bg-clip-text text-transparent">
                    Confirmar senha
                </h1>

                <p class="text-blue-100 mt-3 leading-relaxed">
                    Esta é uma área protegida do sistema. Confirme sua senha para continuar.
                </p>

            </div>

            <div class="p-8">

                <form method="POST"
                      action="{{ route('password.confirm') }}"
                      class="space-y-6">

                    @csrf

                    <div>

                        <label for="password"
                               class="block text-blue-100 font-semibold mb-2">
                            Senha
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Digite sua senha"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-2xl p-4 placeholder-blue-200 focus:border-purple-300 focus:ring-purple-300">

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2 text-red-300" />

                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-3 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white px-7 py-4 rounded-2xl font-bold shadow-[0_0_30px_rgba(168,85,247,.45)] transition hover:scale-[1.02]">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2.4"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Confirmar senha

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-guest-layout>