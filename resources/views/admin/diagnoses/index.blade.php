<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Rekam Medis & Riwayat</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Laporan Diagnosis
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <form method="GET" class="grid gap-4 sm:grid-cols-3">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <i data-lucide="search" class="h-4 w-4"></i>
                        </span>
                        <input name="search" value="{{ request('search') }}" placeholder="Cari nama/email..." class="w-full pl-10 rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" />
                    </div>

                    <select name="depression_id" class="w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50">
                        <option value="">Semua Kategori</option>
                        @foreach ($depressions as $d)
                            <option value="{{ $d->id }}" @selected((string) request('depression_id') === (string) $d->id)>
                                {{ $d->code }} - {{ $d->name }}
                            </option>
                        @endforeach
                    </select>

                    <button class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                        <i data-lucide="sliders-horizontal" class="h-4 w-4"></i>
                        Filter
                    </button>
                </form>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                <th class="py-4 px-4 w-48">Tanggal</th>
                                <th class="py-4 px-4">Pengguna</th>
                                <th class="py-4 px-4">Hasil Diagnosis</th>
                                <th class="py-4 px-4 text-center w-36">Tingkat Keyakinan</th>
                                <th class="py-4 px-4 w-32"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                            @forelse ($items as $item)
                                @php
                                    $percent = round(((float) $item->cf_value) * 100, 2);
                                    $code = $item->depression?->code ?? '';
                                    $badgeStyle = match($code) {
                                        'D1' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20',
                                        'D2' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/20',
                                        'D3' => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-500/10 dark:text-rose-300 dark:border-rose-500/20',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200 dark:bg-slate-500/10 dark:text-slate-300 dark:border-slate-500/20'
                                    };
                                @endphp
                                <tr class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                    <td class="py-4 px-4 whitespace-nowrap text-slate-600 dark:text-slate-300 font-medium">
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="font-bold text-slate-950 dark:text-white">{{ $item->user?->name }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $item->user?->email }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $badgeStyle }}">
                                                {{ $code }}
                                            </span>
                                            <span class="font-bold text-slate-950 dark:text-white">{{ $item->depression?->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center font-bold text-slate-950 dark:text-white whitespace-nowrap">
                                        {{ number_format($percent, 2) }}%
                                    </td>
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.diagnoses.show', $item) }}" class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-slate-300 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                                            <i data-lucide="eye" class="h-3.5 w-3.5"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-slate-500 dark:text-slate-400">
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
