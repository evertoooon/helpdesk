<section>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        class="space-y-6">

        @csrf
        @method('PATCH')

        <div>
            <label
                for="name"
                class="block text-blue-100 mb-2 font-medium">
                Nome
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                maxlength="255"
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
            <label
                for="email"
                class="block text-blue-100 mb-2 font-medium">
                E-mail
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                maxlength="255"
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

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="bg-yellow-500/10 border border-yellow-300/20 rounded-2xl p-4">
                <p class="text-yellow-100 text-sm">
                    Seu e-mail ainda não foi confirmado.
                </p>

                <button
                    type="submit"
                    form="send-verification"
                    class="text-yellow-300 mt-3 hover:text-white transition">
                    Reenviar e-mail de confirmação
                </button>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center gap-4">

            <button
                type="submit"
                class="px-7 py-3 rounded-2xl
                bg-gradient-to-r from-blue-600 to-purple-600
                hover:scale-105
                transition
                text-white
                font-semibold
                shadow-[0_0_25px_rgba(99,102,241,.35)]">
                Salvar alterações
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(function () { show = false }, 2000)"
                    class="text-green-300">
                    Alterações salvas ✔
                </p>
            @endif

        </div>

    </form>

</section>