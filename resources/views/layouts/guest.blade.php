<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MindCare') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <script>
            (() => {
                try {
                    const stored = localStorage.getItem('theme');
                    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'dark' || (!stored && prefersDark)) {
                        document.documentElement.classList.add('dark');
                    }
                } catch (_) {}
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-950 dark:bg-slate-950 dark:text-slate-100">
        <main class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(45,212,191,0.18),transparent_34rem),radial-gradient(circle_at_bottom_right,rgba(125,211,252,0.18),transparent_30rem),linear-gradient(180deg,#f8fafc_0%,#eef8f6_52%,#f8fafc_100%)] px-4 py-6 dark:bg-[radial-gradient(circle_at_top_left,rgba(45,212,191,0.12),transparent_34rem),radial-gradient(circle_at_bottom_right,rgba(56,189,248,0.10),transparent_30rem),linear-gradient(180deg,#020617_0%,#07111f_52%,#020617_100%)] sm:px-6 lg:px-8">
            <div class="mx-auto flex min-h-[calc(100vh-3rem)] w-full max-w-6xl items-center justify-center">
                <div class="grid w-full overflow-hidden rounded-[2rem] border border-white/70 bg-white/70 shadow-2xl shadow-slate-300/40 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/30 lg:grid-cols-[0.95fr_1.05fr]">
                    <section class="relative hidden min-h-[42rem] overflow-hidden bg-slate-950 p-10 text-white lg:block">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(20,184,166,0.45),transparent_24rem),radial-gradient(circle_at_bottom_right,rgba(56,189,248,0.34),transparent_22rem)]"></div>
                        <div class="relative z-10 flex h-full flex-col justify-between">
                            <a href="{{ route('user.home') }}" class="inline-flex items-center gap-3">
                                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-500 text-white shadow-lg shadow-teal-500/25">
                                    <i data-lucide="heart-pulse" class="h-6 w-6"></i>
                                </span>
                                <span class="text-lg font-black tracking-tight">MindCare</span>
                            </a>

                            <div>
                                <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs font-bold text-teal-100">
                                    <i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
                                    Panel Administrasi
                                </div>
                                <h1 class="mt-5 max-w-md text-5xl font-black tracking-tight">
                                    Kelola sistem pakar dari satu tempat.
                                </h1>
                                <p class="mt-5 max-w-md text-base leading-7 text-slate-300">
                                    Masuk sebagai admin untuk mengelola data gejala, depresi, rules, rekomendasi, dan melihat laporan diagnosis mahasiswa.
                                </p>
                            </div>

                            <div class="grid gap-3">
                                @foreach ([
                                    ['layout-dashboard', 'Dashboard dengan statistik dan grafik diagnosis.'],
                                    ['database', 'Kelola master data gejala, depresi, dan rules.'],
                                    ['file-text', 'Laporan lengkap hasil diagnosis mahasiswa.'],
                                ] as [$icon, $copy])
                                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/10 text-teal-100">
                                            <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
                                        </span>
                                        <p class="text-sm font-medium text-slate-200">{{ $copy }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <section class="p-6 sm:p-8 lg:p-12">
                        <div class="mb-8 flex items-center justify-between">
                            <a href="{{ route('user.home') }}" class="inline-flex items-center gap-3 lg:hidden">
                                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-teal-500 text-white shadow-lg shadow-teal-500/20">
                                    <i data-lucide="heart-pulse" class="h-5 w-5"></i>
                                </span>
                                <span class="text-base font-black tracking-tight text-slate-950 dark:text-white">MindCare</span>
                            </a>

                            <button
                                type="button"
                                class="ms-auto inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white/80 text-slate-600 shadow-sm transition hover:-translate-y-0.5 hover:bg-teal-50 hover:text-teal-700 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
                                title="Toggle dark mode"
                                onclick="(() => { const el=document.documentElement; const isDark=el.classList.toggle('dark'); try{localStorage.setItem('theme', isDark?'dark':'light');}catch(_){}})()"
                            >
                                <i data-lucide="moon" class="h-4 w-4"></i>
                            </button>
                        </div>

                        <div class="mx-auto w-full max-w-md">
                            {{ $slot }}
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        </script>
    </body>
</html>
