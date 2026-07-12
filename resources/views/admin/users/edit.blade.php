<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Sistem & Akses</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Detail Pengguna
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div class="flex items-center gap-4">
                    <span class="grid h-14 w-14 place-items-center rounded-full bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                        <i data-lucide="user" class="h-7 w-7"></i>
                    </span>
                    <div>
                        <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase">Admin</div>
                        <div class="font-extrabold text-slate-900 dark:text-white text-xl">{{ $user->name }}</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-white/5">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                            <i data-lucide="arrow-left" class="h-4 w-4"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
