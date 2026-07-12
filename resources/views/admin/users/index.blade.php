<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Sistem & Akses</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Data Pengguna
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-96">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <i data-lucide="search" class="h-4 w-4"></i>
                        </span>
                        <input name="search" value="{{ request('search') }}" placeholder="Cari nama/email..." class="w-full pl-10 rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" />
                    </div>
                    <button class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                        <i data-lucide="search" class="h-4 w-4"></i>
                        Cari
                    </button>
                </form>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                <th class="py-4 px-4">Nama</th>
                                <th class="py-4 px-4">Email</th>
                                <th class="py-4 px-4 w-28"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                            @forelse ($items as $item)
                                <tr class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                    <td class="py-4 px-4 font-bold text-slate-950 dark:text-white">{{ $item->name }}</td>
                                    <td class="py-4 px-4 text-slate-600 dark:text-slate-300 font-medium">{{ $item->email }}</td>
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.users.edit', $item) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:hover:bg-white/10" title="Edit">
                                            <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-12 text-center text-slate-500 dark:text-slate-400">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <span class="grid h-12 w-12 place-items-center rounded-full bg-slate-100 text-slate-400 dark:bg-white/5">
                                                <i data-lucide="database" class="h-6 w-6"></i>
                                            </span>
                                            <p class="font-medium text-sm">Data kosong</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
