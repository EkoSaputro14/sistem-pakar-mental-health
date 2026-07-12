<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Rekam Medis & Riwayat</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Detail Diagnosis
                </h2>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.diagnoses.pdf', $diagnosis) }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                    <i data-lucide="file-text" class="h-4 w-4"></i>
                    Export PDF
                </a>
                <button type="button" onclick="window.print()" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                    <i data-lucide="printer" class="h-4 w-4"></i>
                    Print
                </button>
            </div>
        </div>
    </x-slot>

    @php
        $code = $diagnosis->depression?->code ?? '';
        $themeColor = match($code) {
            'D1' => 'teal',
            'D2' => 'amber',
            'D3' => 'rose',
            default => 'slate'
        };
        $themeClass = match($code) {
            'D1' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20',
            'D2' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/20',
            'D3' => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-500/10 dark:text-rose-300 dark:border-rose-500/20',
            default => 'bg-slate-50 text-slate-700 border-slate-200 dark:bg-slate-500/10 dark:text-slate-300 dark:border-slate-500/20'
        };
        $progressColorClass = match($code) {
            'D1' => 'bg-emerald-500',
            'D2' => 'bg-amber-500',
            'D3' => 'bg-rose-500',
            default => 'bg-slate-500'
        };
    @endphp

    <div class="py-6 sm:py-10 print:py-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Summary Card -->
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="flex items-start gap-3.5">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="user" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase">Pengguna / Mahasiswa</div>
                            <div class="mt-1 font-bold text-slate-900 dark:text-white">{{ $diagnosis->user?->name }}</div>
                            <div class="text-sm text-slate-600 dark:text-slate-400">{{ $diagnosis->user?->email }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3.5">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="calendar" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase">Waktu Pemeriksaan</div>
                            <div class="mt-1 font-bold text-slate-900 dark:text-white">{{ $diagnosis->created_at->format('d M Y H:i') }}</div>
                            <div class="text-sm text-slate-600 dark:text-slate-400">Zona Waktu Server</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3.5">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="activity" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase">Hasil Diagnosis</div>
                            <div class="mt-1 font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $themeClass }}">
                                    {{ $code }}
                                </span>
                                {{ $diagnosis->depression?->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-white/5">
                    <div class="flex items-end justify-between">
                        <div>
                            <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase">Tingkat Keyakinan (Certainty Factor)</div>
                            <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">CF Value: {{ $diagnosis->cf_value }}</div>
                        </div>
                        <div class="text-3xl font-extrabold text-{{ $themeColor }}-600 dark:text-{{ $themeColor }}-400">{{ number_format($confidencePercent, 2) }}%</div>
                    </div>
                    <div class="mt-3.5 h-3.5 w-full overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                        <div id="cfBar" class="h-full w-0 rounded-full {{ $progressColorClass }} transition-all duration-700"></div>
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <!-- CF Breakdown -->
                    <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                        <div class="flex items-center gap-2 font-bold text-slate-950 dark:text-white">
                            <i data-lucide="bar-chart-2" class="h-5 w-5 text-teal-600"></i>
                            <span>Perbandingan Nilai CF per Kategori</span>
                        </div>
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full text-sm text-left">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                        <th class="py-3 px-4">Kategori Depresi</th>
                                        <th class="py-3 px-4 text-center">Nilai CF</th>
                                        <th class="py-3 px-4 text-center">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                                    @foreach (($diagnosis->cf_breakdown ?? []) as $breakCode => $cf)
                                        @php
                                            $breakStyle = match($breakCode) {
                                                'D1' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20',
                                                'D2' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/20',
                                                'D3' => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-500/10 dark:text-rose-300 dark:border-rose-500/20',
                                                default => 'bg-slate-50 text-slate-700 border-slate-200 dark:bg-slate-500/10 dark:text-slate-300 dark:border-slate-500/20'
                                            };
                                        @endphp
                                        <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                            <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">
                                                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $breakStyle }}">
                                                    {{ $breakCode }}
                                                </span>
                                            </td>
                                            <td class="py-3.5 px-4 text-center text-slate-600 dark:text-slate-300 font-mono">{{ number_format((float) $cf, 4) }}</td>
                                            <td class="py-3.5 px-4 text-center font-bold text-slate-950 dark:text-white">{{ number_format(((float) $cf) * 100, 2) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Symptoms Details -->
                    <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                        <div class="flex items-center gap-2 font-bold text-slate-950 dark:text-white">
                            <i data-lucide="check-square" class="h-5 w-5 text-teal-600"></i>
                            <span>Detail Jawaban Gejala</span>
                        </div>
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full text-sm text-left">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider text-xs">
                                        <th class="py-3 px-4">Gejala</th>
                                        <th class="py-3 px-4 text-center w-28">Jawaban</th>
                                        <th class="py-3 px-4 text-center w-24">CF Pakar</th>
                                        <th class="py-3 px-4 text-center w-24">CF User</th>
                                        <th class="py-3 px-4 text-center w-24">CF(H,E)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                                    @foreach ($diagnosis->details as $detail)
                                        <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-white/5">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center gap-2.5">
                                                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2 py-0.5 text-xs font-bold text-slate-600 dark:bg-white/5 dark:text-slate-300 dark:border-white/10">
                                                        {{ $detail->symptom->code ?? '-' }}
                                                    </span>
                                                    <span class="font-medium text-slate-700 dark:text-slate-300 leading-relaxed">{{ $detail->symptom->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold bg-slate-100 text-slate-800 dark:bg-white/5 dark:text-slate-300">
                                                    {{ $detail->user_answer }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 text-center font-bold text-slate-900 dark:text-white font-mono">{{ number_format((float) $detail->expert_cf, 2) }}</td>
                                            <td class="py-4 px-4 text-center font-bold text-slate-900 dark:text-white font-mono">{{ number_format((float) $detail->user_cf, 2) }}</td>
                                            <td class="py-4 px-4 text-center font-bold text-teal-600 dark:text-teal-400 font-mono">{{ number_format((float) $detail->cf_he, 4) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recommendations & Sidebar -->
                <div class="space-y-6">
                    <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                        <div class="flex items-center gap-2 font-bold text-slate-950 dark:text-white">
                            <i data-lucide="heart-handshake" class="h-5 w-5 text-teal-600"></i>
                            <span>Rekomendasi Tindakan</span>
                        </div>
                        <div class="mt-4 space-y-4">
                            @forelse ($recommendations as $rec)
                                <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-4 dark:border-white/5 dark:bg-white/5 space-y-2">
                                    <div class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                        <span class="h-2 w-2 rounded-full bg-teal-500"></span>
                                        {{ $rec->title }}
                                    </div>
                                    <div class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $rec->content }}</div>
                                </div>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-200 p-6 text-center text-slate-400 dark:border-white/10">
                                    <i data-lucide="help-circle" class="mx-auto h-8 w-8 opacity-40"></i>
                                    <p class="mt-2 text-xs font-semibold">Belum ada rekomendasi untuk kategori ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <a href="{{ route('admin.diagnoses.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        Kembali ke Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const target = {{ (float) $confidencePercent }};
            const bar = document.getElementById('cfBar');
            if (!bar) return;
            requestAnimationFrame(() => {
                bar.style.width = Math.max(0, Math.min(100, target)) + '%';
            });
        })();
    </script>
</x-app-layout>
