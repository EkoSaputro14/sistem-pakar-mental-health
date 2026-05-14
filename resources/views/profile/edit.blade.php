<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Account settings</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Profil Anda
                </h2>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-4 py-2 text-sm font-semibold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
                <i data-lucide="shield-check" class="h-4 w-4"></i>
                Akun aman
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="grid gap-6 lg:grid-cols-[0.38fr_0.62fr]">
                <aside class="rounded-[2rem] border border-white/70 bg-slate-950 p-6 text-white shadow-xl shadow-slate-300/40 dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center gap-4">
                        <div class="grid h-16 w-16 place-items-center rounded-3xl bg-teal-500 text-2xl font-black shadow-lg shadow-teal-500/20">
                            {{ str($user->name)->substr(0, 1)->upper() }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="truncate text-xl font-bold">{{ $user->name }}</h3>
                            <p class="truncate text-sm text-slate-300">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-3">
                        @foreach ([
                            ['user-round-check', 'Informasi profil', 'Perbarui nama dan alamat email.'],
                            ['key-round', 'Keamanan', 'Gunakan password kuat untuk melindungi akun.'],
                            ['history', 'Riwayat privat', 'Data diagnosis tersimpan pada akun Anda.'],
                        ] as [$icon, $title, $copy])
                            <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                                <div class="flex gap-3">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-white/10 text-teal-100">
                                        <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
                                    </span>
                                    <div>
                                        <h4 class="text-sm font-bold text-white">{{ $title }}</h4>
                                        <p class="mt-1 text-xs leading-5 text-slate-300">{{ $copy }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 rounded-2xl border border-amber-200/20 bg-amber-200/10 p-4 text-sm leading-6 text-amber-50">
                        <div class="flex gap-3">
                            <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0"></i>
                            <p>Pastikan email aktif agar notifikasi dan pemulihan akun tetap dapat digunakan.</p>
                        </div>
                    </div>
                </aside>

                <div class="space-y-6">
                    <div class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-7">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-7">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="rounded-[2rem] border border-rose-200/70 bg-rose-50/80 p-5 shadow-lg shadow-rose-100/40 backdrop-blur-xl dark:border-rose-400/20 dark:bg-rose-500/10 dark:shadow-black/20 sm:p-7">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
