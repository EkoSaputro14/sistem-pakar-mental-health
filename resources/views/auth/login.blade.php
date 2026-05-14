<x-guest-layout>
    <div>
        <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
            <i data-lucide="log-in" class="h-3.5 w-3.5"></i>
            Welcome back
        </div>
        <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-950 dark:text-white">
            Masuk ke akun Anda
        </h1>
        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
            Lanjutkan skrining kesehatan mental dan pantau hasil diagnosis Anda dengan nyaman.
        </p>
    </div>

    <x-auth-session-status class="mt-6 rounded-2xl border border-teal-100 bg-teal-50 px-4 py-3 text-sm font-medium text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="mail" class="h-4 w-4"></i>
                </span>
                <x-text-input id="email" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-bold text-slate-700 dark:text-slate-200" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-teal-700 transition hover:text-teal-900 dark:text-teal-300 dark:hover:text-teal-100" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="relative mt-2">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i data-lucide="lock-keyhole" class="h-4 w-4"></i>
                </span>
                <x-text-input id="password" class="block h-12 w-full rounded-2xl border-slate-200 bg-white/80 pl-11 text-sm shadow-sm transition focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white/60 px-4 py-3 text-sm font-semibold text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 dark:border-white/20 dark:bg-white/10" name="remember">
            <span>{{ __('Remember me') }}</span>
        </label>

        <button type="submit" class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-sm font-bold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:bg-white dark:text-slate-950 dark:hover:bg-teal-100 dark:focus:ring-offset-slate-950">
            Masuk
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
        </button>
    </form>

    <p class="mt-8 text-center text-sm text-slate-600 dark:text-slate-300">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-bold text-teal-700 transition hover:text-teal-900 dark:text-teal-300 dark:hover:text-teal-100">
            Daftar sekarang
        </a>
    </p>
</x-guest-layout>
