<x-app-layout>

    <div class="space-y-8">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            <div class="w-16 h-16 rounded-3xl bg-blue-500/20 border border-blue-300/30 shadow-[0_0_30px_rgba(59,130,246,.45)] flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 0115 0"/>
                </svg>
            </div>

            <div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent break-words">
                    Meu Perfil
                </h1>

                <p class="text-blue-100 mt-2 text-lg">
                    Atualize suas informações pessoais e configurações da conta.
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <section class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

                <div class="p-6 border-b border-white/10 flex items-center gap-4">

                    <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,.35)]">
                        <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 0115 0"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            Informações do perfil
                        </h2>

                        <p class="text-blue-200 text-sm">
                            Altere seu nome e endereço de e-mail.
                        </p>
                    </div>

                </div>

                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </section>

            <section class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl overflow-hidden">

                <div class="p-6 border-b border-white/10 flex items-center gap-4">

                    <div class="w-11 h-11 rounded-2xl bg-purple-500/20 border border-purple-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(168,85,247,.35)]">
                        <svg class="w-6 h-6 text-purple-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 00-9 0v3"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 10.5h10.5A1.75 1.75 0 0119 12.25v6A1.75 1.75 0 0117.25 20H6.75A1.75 1.75 0 015 18.25v-6a1.75 1.75 0 011.75-1.75z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            Segurança
                        </h2>

                        <p class="text-blue-200 text-sm">
                            Atualize sua senha de acesso.
                        </p>
                    </div>

                </div>

                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>

            </section>

            <section class="lg:col-span-2 bg-gradient-to-br from-red-500/15 to-white/5 backdrop-blur-xl rounded-3xl border border-red-300/20 shadow-2xl overflow-hidden">

                <div class="p-6 border-b border-white/10 flex items-center gap-4">

                    <div class="w-11 h-11 rounded-2xl bg-red-500/20 border border-red-300/30 flex items-center justify-center shadow-[0_0_20px_rgba(239,68,68,.35)]">
                        <svg class="w-6 h-6 text-red-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l1 14h10l1-14"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            Excluir conta
                        </h2>

                        <p class="text-red-100 text-sm">
                            Área sensível. Esta ação não pode ser desfeita.
                        </p>
                    </div>

                </div>

                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>

            </section>

        </div>

    </div>

</x-app-layout>