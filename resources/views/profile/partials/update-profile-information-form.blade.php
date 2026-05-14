<section>
    <header class="flex items-start gap-4">
        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-200">
            <i data-lucide="user-round-cog" class="h-6 w-6"></i>
        </span>
        <div>
            <h2 class="text-lg font-bold text-slate-950 dark:text-white">
                Informasi Profil
            </h2>

            <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-300">
                Perbarui nama dan email yang terhubung dengan akun MindCare Anda.
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="user-round" class="h-4 w-4"></i>
                </span>
                <x-text-input id="name" name="name" type="text" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="mail" class="h-4 w-4"></i>
                </span>
                <x-text-input id="email" name="email" type="email" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900 dark:border-amber-300/20 dark:bg-amber-300/10 dark:text-amber-100">
                    <p>
                        Email Anda belum terverifikasi.

                        <button form="send-verification" class="font-bold underline underline-offset-4 transition hover:text-amber-700 dark:hover:text-amber-50">
                            Kirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-teal-700 dark:text-teal-200">
                            Link verifikasi baru sudah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-slate-950 px-5 text-sm font-bold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:bg-white dark:text-slate-950 dark:hover:bg-teal-100 dark:focus:ring-offset-slate-950">
                <i data-lucide="save" class="h-4 w-4"></i>
                Simpan Profil
            </button>

            @if (session('status') === 'profile-updated')
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
