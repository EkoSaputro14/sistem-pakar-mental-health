<x-guest-layout>
    <div>
        <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
            <i data-lucide="user-plus" class="h-3.5 w-3.5"></i>
            Create your space
        </div>
        <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-950 dark:text-white">
            Buat akun MindCare
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
            Mulai skrining dengan pengalaman yang tenang, privat, dan mudah dipahami.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="user-round" class="h-4 w-4"></i>
                </span>
                <x-text-input id="name" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="mail" class="h-4 w-4"></i>
                </span>
                <x-text-input id="email" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i data-lucide="lock-keyhole" class="h-4 w-4"></i>
                    </span>
                    <x-text-input id="password" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i data-lucide="badge-check" class="h-4 w-4"></i>
                    </span>
                    <x-text-input id="password_confirmation" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="rounded-2xl border border-sky-100 bg-sky-50/80 p-4 text-sm leading-6 text-sky-800 dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-100">
            <div class="flex gap-3">
                <i data-lucide="shield" class="mt-0.5 h-5 w-5 shrink-0"></i>
                <p>Akun Anda digunakan untuk menyimpan riwayat diagnosis dan rekomendasi secara privat.</p>
            </div>
        </div>

        <button type="submit" class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-teal-600 px-5 text-sm font-bold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950">
            Daftar
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
        </button>
    </form>

    <p class="mt-8 text-center text-sm text-slate-600 dark:text-slate-300">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-bold text-teal-700 transition hover:text-teal-900 dark:text-teal-300 dark:hover:text-teal-100">
            Masuk
        </a>
    </p>
</x-guest-layout>
