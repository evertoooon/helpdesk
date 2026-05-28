<section>

    <header class="mb-6">

        <h2 class="text-2xl font-bold text-red-200">
            Excluir conta
        </h2>

        <p class="mt-2 text-red-100 leading-relaxed">
            Ao excluir sua conta, todos os dados associados poderão ser removidos permanentemente.
            Antes de continuar, confirme sua senha.
        </p>

    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-7 py-3 rounded-2xl
        bg-gradient-to-r from-red-600 to-rose-600
        hover:scale-105
        transition
        text-white
        font-semibold
        shadow-[0_0_25px_rgba(239,68,68,.35)]">

        Excluir conta

    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            class="p-8 space-y-6 bg-slate-900">

            @csrf
            @method('DELETE')

            <h2 class="text-2xl font-bold text-white">
                Confirmar exclusão
            </h2>

            <p class="text-blue-100 leading-relaxed">
                Esta ação é permanente e não poderá ser desfeita. Para confirmar,
                digite sua senha abaixo.
            </p>

            <div>
                <label
                    for="delete_user_password"
                    class="block text-blue-100 mb-2">
                    Digite sua senha
                </label>

                <input
                    id="delete_user_password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                    focus:border-red-400
                    focus:ring focus:ring-red-500/20">

                @error('password', 'userDeletion')
                    <p class="text-red-300 mt-2 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-4">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-6 py-3 rounded-2xl
                    bg-white/10
                    hover:bg-white/20
                    text-white
                    transition">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-2xl
                    bg-gradient-to-r from-red-600 to-rose-600
                    hover:from-red-500 hover:to-rose-500
                    text-white
                    font-semibold
                    transition">

                    Excluir definitivamente

                </button>

            </div>

        </form>

    </x-modal>

</section>