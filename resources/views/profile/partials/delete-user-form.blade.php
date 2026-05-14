<section class="space-y-6">
    <header class="flex items-start gap-4">
        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-rose-100 text-rose-700 dark:bg-rose-400/10 dark:text-rose-200">
            <i data-lucide="trash-2" class="h-6 w-6"></i>
        </span>
        <div>
            <h2 class="text-lg font-bold text-rose-950 dark:text-rose-50">
                Hapus Akun
            </h2>

            <p class="mt-1 text-sm leading-6 text-rose-900/75 dark:text-rose-100/80">
                Setelah akun dihapus, seluruh data akun dan riwayat yang terkait akan terhapus permanen.
            </p>
        </div>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-rose-600 px-5 text-sm font-bold text-white shadow-lg shadow-rose-600/20 transition hover:-translate-y-0.5 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
    >
        <i data-lucide="trash-2" class="h-4 w-4"></i>
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="bg-white p-6 dark:bg-slate-950">
            @csrf
            @method('delete')

            <div class="flex items-start gap-4">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-rose-100 text-rose-700 dark:bg-rose-400/10 dark:text-rose-200">
                    <i data-lucide="triangle-alert" class="h-6 w-6"></i>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-slate-950 dark:text-white">
                        Yakin ingin menghapus akun?
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                        Masukkan password untuk mengonfirmasi penghapusan permanen akun dan data terkait.
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i data-lucide="lock-keyhole" class="h-4 w-4"></i>
                    </span>
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-rose-500 focus:ring-rose-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500"
                        placeholder="{{ __('Password') }}"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex h-11 items-center justify-center rounded-full border border-slate-200 bg-white px-5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                    Batal
                </button>

                <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-rose-600 px-5 text-sm font-bold text-white shadow-lg shadow-rose-600/20 transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
