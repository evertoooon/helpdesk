<section>

    <header class="mb-6">

        <h2 class="text-2xl font-bold text-red-200">
            Excluir conta
        </h2>

        <p class="mt-2 text-red-100">
            Ao excluir sua conta, todos os dados associados serão removidos permanentemente.
            Antes de continuar, confirme sua senha.
        </p>

    </header>

    <button
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

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post"
              action="{{ route('profile.destroy') }}"
              class="p-8 space-y-6 bg-slate-900">

            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-white">

                Confirmar exclusão

            </h2>

            <p class="text-blue-100">

                Esta ação é permanente e não poderá ser desfeita.

            </p>

            <div>

                <label class="block text-blue-100 mb-2">
                    Digite sua senha
                </label>

                <input
                    name="password"
                    type="password"

                    class="w-full rounded-2xl bg-white/10 border border-white/10 text-white
                    focus:border-red-400
                    focus:ring focus:ring-red-500/20">

                @error('password','userDeletion')

                    <p class="text-red-300 mt-2 text-sm">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div class="flex justify-end gap-4">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"

                    class="px-6 py-3 rounded-2xl
                    bg-white/10
                    text-white">

                    Cancelar

                </button>

                <button
                    type="submit"

                    class="px-6 py-3 rounded-2xl
                    bg-gradient-to-r from-red-600 to-rose-600
                    text-white">

                    Excluir definitivamente

                </button>

            </div>

        </form>

    </x-modal>

</section>