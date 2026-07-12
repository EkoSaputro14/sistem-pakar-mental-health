<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Manajemen Data</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Rule Diagnosis
                </h2>
            </div>
            <a href="{{ route('admin.rules.create') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Rule
            </a>
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
                        <input name="search" value="{{ request('search') }}" placeholder="Cari kategori/gejala..." class="w-full pl-10 rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" />
                    </div>
                    <button class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">Cari</button>
                </form>

                <div class="mt-4 flex gap-2 items-center rounded-2xl bg-teal-50/50 border border-teal-100 p-4 text-xs text-teal-800 dark:bg-teal-950/20 dark:border-teal-900/30 dark:text-teal-300">
                    <i data-lucide="info" class="h-4 w-4 shrink-0"></i>
                    <span>CF pakar di sini dipakai sebagai nilai <span class="font-bold">CFpakar</span> pada rumus CF(H,E).</span>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                <th class="py-4 px-4">Kategori Depresi</th>
                                <th class="py-4 px-4">Gejala</th>
                                <th class="py-4 px-4 text-center w-36">CF Pakar</th>
                                <th class="py-4 px-4 w-36"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                            @forelse ($items as $item)
                                @php
                                    $code = $item->depression?->code ?? '';
                                    $badgeStyle = match($code) {
                                        'D1' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20',
                                        'D2' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/20',
                                        'D3' => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-500/10 dark:text-rose-300 dark:border-rose-500/20',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200 dark:bg-slate-500/10 dark:text-slate-300 dark:border-slate-500/20'
                                    };
                                @endphp
                                <tr class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $badgeStyle }}">
                                                {{ $code }}
                                            </span>
                                            <span class="font-bold text-slate-950 dark:text-white">{{ $item->depression?->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2 py-0.5 text-xs font-bold text-slate-600 dark:bg-white/5 dark:text-slate-300 dark:border-white/10">
                                                {{ $item->symptom?->code }}
                                            </span>
                                            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $item->symptom?->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center font-bold text-slate-950 dark:text-white">{{ number_format((float) $item->expert_cf, 2) }}</td>
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('admin.rules.edit', $item->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:hover:bg-white/10" title="Edit">
                                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                            </a>
                                            <form class="inline" method="POST" action="{{ route('admin.rules.destroy', $item->id) }}" onsubmit="return confirm('Hapus rule ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-rose-100 bg-white text-rose-600 shadow-sm transition hover:bg-rose-50 hover:text-rose-900 dark:border-rose-500/10 dark:bg-white/5 dark:text-rose-400 dark:hover:bg-rose-500/20" title="Hapus">
                                                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-slate-500 dark:text-slate-400">
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
