<section>
    <header class="flex items-start gap-4">
        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-sky-50 text-sky-700 dark:bg-sky-400/10 dark:text-sky-200">
            <i data-lucide="key-round" class="h-6 w-6"></i>
        </span>
        <div>
            <h2 class="text-lg font-bold text-slate-950 dark:text-white">
                Update Password
            </h2>

            <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-300">
                Gunakan password panjang dan unik agar akun serta riwayat diagnosis tetap terlindungi.
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="lock-keyhole" class="h-4 w-4"></i>
                </span>
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i data-lucide="sparkles" class="h-4 w-4"></i>
                    </span>
                    <x-text-input id="update_password_password" name="password" type="password" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i data-lucide="badge-check" class="h-4 w-4"></i>
                    </span>
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="rounded-2xl border border-sky-100 bg-sky-50/80 p-4 text-sm leading-6 text-sky-800 dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-100">
            <div class="flex gap-3">
                <i data-lucide="shield" class="mt-0.5 h-5 w-5 shrink-0"></i>
                <p>Password baru akan langsung digunakan untuk login berikutnya.</p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-teal-600 px-5 text-sm font-bold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950">
                <i data-lucide="key-round" class="h-4 w-4"></i>
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="inline-flex items-center gap-2 rounded-full bg-teal-50 px-3 py-2 text-sm font-bold text-teal-700 dark:bg-teal-400/10 dark:text-teal-200"
                >
                    <i data-lucide="check" class="h-4 w-4"></i>
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>
