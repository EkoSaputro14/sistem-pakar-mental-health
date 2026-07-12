<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Riwayat Skrining</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Riwayat Diagnosis
                </h2>
            </div>
            <a href="{{ route('user.diagnosis') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Diagnosis Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                x-data="{
                    items: [],
                    init() {
                        try { this.items = JSON.parse(localStorage.getItem('mindcare_riwayat') || '[]'); } catch(e) { this.items = []; }
                    },
                    clear() {
                        if (confirm('Hapus semua riwayat?')) {
                            localStorage.removeItem('mindcare_riwayat');
                            this.items = [];
                        }
                    },
                    removeItem(id) {
                        this.items = this.items.filter(r => r.id !== id);
                        localStorage.setItem('mindcare_riwayat', JSON.stringify(this.items));
                    }
                }"
                class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8"
            >
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-950 dark:text-white">Daftar Riwayat Diagnosis</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Riwayat tersimpan di browser Anda. Data akan hilang jika cache browser dihapus.</p>
                    </div>
                    <button x-show="items.length > 0" x-on:click="clear()" class="inline-flex items-center gap-1.5 rounded-full border border-rose-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-rose-600 shadow-sm transition hover:bg-rose-50 dark:border-rose-500/20 dark:bg-white/5 dark:text-rose-400">
                        <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                        Hapus Semua
                    </button>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                <th class="py-4 px-4">Tanggal</th>
                                <th class="py-4 px-4">Hasil Diagnosis</th>
                                <th class="py-4 px-4 text-center">Tingkat Keyakinan</th>
                                <th class="py-4 px-4 w-32"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                            <template x-for="item in items" :key="item.id">
                                <tr class="group transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                    <td class="py-4 px-4 whitespace-nowrap text-slate-600 dark:text-slate-300 font-medium" x-text="item.date"></td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold"
                                                :class="{
                                                    'bg-emerald-50 text-emerald-700 border-emerald-200': item.result === 'D1',
                                                    'bg-amber-50 text-amber-700 border-amber-200': item.result === 'D2',
                                                    'bg-rose-50 text-rose-700 border-rose-200': item.result === 'D3',
                                                    'bg-slate-50 text-slate-700 border-slate-200': !['D1','D2','D3'].includes(item.result)
                                                }"
                                                x-text="item.result"></span>
                                            <span class="font-bold text-slate-950 dark:text-white" x-text="item.name"></span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="inline-flex items-center gap-2">
                                            <div class="w-16 h-2 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                                                <div class="h-full rounded-full bg-teal-500" :style="'width: ' + (item.cf * 100).toFixed(2) + '%'"></div>
                                            </div>
                                            <span class="font-bold text-slate-950 dark:text-white" x-text="(item.cf * 100).toFixed(2) + '%'"></span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a :href="'/hasil/' + item.id" class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-slate-300 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                                                <i data-lucide="eye" class="h-3.5 w-3.5"></i>
                                                Detail
                                            </a>
                                            <button x-on:click="removeItem(item.id)" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-rose-100 bg-white text-rose-600 shadow-sm transition hover:bg-rose-50 dark:border-rose-500/10 dark:bg-white/5 dark:text-rose-400" title="Hapus">
                                                <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div x-show="items.length === 0" class="py-12 text-center">
                    <div class="flex flex-col items-center justify-center gap-3">
                        <span class="grid h-12 w-12 place-items-center rounded-full bg-slate-100 text-slate-400 dark:bg-white/5">
                            <i data-lucide="history" class="h-6 w-6"></i>
                        </span>
                        <p class="font-medium text-sm text-slate-500 dark:text-slate-400">Belum ada riwayat diagnosis</p>
                        <a href="{{ route('user.diagnosis') }}" class="mt-2 inline-flex items-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                            <i data-lucide="clipboard-list" class="h-4 w-4"></i>
                            Mulai Diagnosis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
