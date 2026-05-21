<section>

    <form method="post"
          action="{{ route('password.update') }}"
          class="space-y-6">

        @csrf
        @method('put')

        <div>

            <label class="block text-blue-100 mb-2 font-medium">
                Senha atual
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"

                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                placeholder:text-blue-200/50
                focus:border-purple-400
                focus:ring focus:ring-purple-500/20
                transition">

            @error('current_password', 'updatePassword')
                <p class="text-red-300 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div>

            <label class="block text-blue-100 mb-2 font-medium">
                Nova senha
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"

                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                placeholder:text-blue-200/50
                focus:border-purple-400
                focus:ring focus:ring-purple-500/20
                transition">

            @error('password', 'updatePassword')
                <p class="text-red-300 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div>

            <label class="block text-blue-100 mb-2 font-medium">
                Confirmar nova senha
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"

                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                placeholder:text-blue-200/50
                focus:border-purple-400
                focus:ring focus:ring-purple-500/20
                transition">

            @error('password_confirmation', 'updatePassword')
                <p class="text-red-300 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="flex items-center gap-4">

            <button
                type="submit"

                class="px-7 py-3 rounded-2xl
                bg-gradient-to-r from-purple-600 to-blue-600
                hover:scale-105
                transition
                text-white
                font-semibold
                shadow-[0_0_25px_rgba(168,85,247,.35)]">

                Atualizar senha

            </button>

            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show:true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show=false,2000)"

                    class="text-green-300">

                    Senha atualizada ✔

                </p>

            @endif

        </div>

    </form>

</section>