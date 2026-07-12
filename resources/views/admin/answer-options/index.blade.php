<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Manajemen Data</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Opsi Jawaban
                </h2>
            </div>
            <a href="{{ route('admin.answer-options.create') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Opsi
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div>
                    <h3 class="text-lg font-bold text-slate-950 dark:text-white">Daftar Opsi Jawaban</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Opsi yang ditampilkan saat user mengisi diagnosis. Nilai CF User ditentukan oleh pilihan ini.</p>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                <th class="py-4 px-4 w-20">Urutan</th>
                                <th class="py-4 px-4">Label</th>
                                <th class="py-4 px-4 text-center w-32">Nilai CF</th>
                                <th class="py-4 px-4 text-center w-28">Status</th>
                                <th class="py-4 px-4 w-36"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                            @forelse ($items as $item)
                                <tr class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                    <td class="py-4 px-4 text-center font-bold text-slate-500 dark:text-slate-400">{{ $item->sort_order }}</td>
                                    <td class="py-4 px-4 font-bold text-slate-950 dark:text-white">{{ $item->label }}</td>
                                    <td class="py-4 px-4 text-center font-extrabold text-teal-600 dark:text-teal-400">{{ number_format((float) $item->value, 1) }}</td>
                                    <td class="py-4 px-4 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $item->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20' : 'bg-slate-50 text-slate-600 border-slate-200 dark:bg-white/5 dark:text-slate-400 dark:border-white/10' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('admin.answer-options.edit', $item->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:hover:bg-white/10" title="Edit">
                                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                            </a>
                                            <form class="inline" method="POST" action="{{ route('admin.answer-options.destroy', $item->id) }}" onsubmit="return confirm('Hapus opsi jawaban ini?')">
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
            </div>
        </div>
    </div>
</x-app-layout>
