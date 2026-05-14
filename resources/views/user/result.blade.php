<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Diagnosis insight</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Hasil Diagnosis
                </h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('user.result.pdf', $diagnosis) }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                    <i data-lucide="download" class="h-4 w-4"></i>
                    PDF
                </a>
                <button type="button" onclick="window.print()" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white/80 px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                    <i data-lucide="printer" class="h-4 w-4"></i>
                    Print
                </button>
            </div>
        </div>
    </x-slot>

    @php
        $breakdown = collect($diagnosis->cf_breakdown ?? []);
        $chartLabels = $breakdown->keys()->values();
        $chartValues = $breakdown->values()->map(fn ($value) => round(((float) $value) * 100, 2))->values();
        $circleValue = max(0, min(100, (float) $confidencePercent));
    @endphp

    <div class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="grid gap-6 lg:grid-cols-[0.85fr_1.15fr]">
                <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Diagnosis akhir</p>
                            <h3 class="mt-2 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                                {{ $diagnosis->depression?->name ?? '-' }}
                            </h3>
                            <p class="mt-1 text-sm font-semibold text-teal-700 dark:text-teal-300">{{ $diagnosis->depression?->code }}</p>
                        </div>
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-200">
                            <i data-lucide="brain-circuit" class="h-6 w-6"></i>
                        </span>
                    </div>

                    <div class="mt-8 flex flex-col items-center">
                        <div
                            class="grid h-48 w-48 place-items-center rounded-full shadow-inner transition-all duration-1000"
                            style="background: conic-gradient(#0d9488 {{ $circleValue }}%, rgba(148, 163, 184, 0.22) 0);"
                        >
                            <div class="grid h-36 w-36 place-items-center rounded-full bg-white text-center shadow-lg dark:bg-slate-950">
                                <div>
                                    <div class="text-4xl font-black tracking-tight text-slate-950 dark:text-white">{{ number_format($confidencePercent, 2) }}%</div>
                                    <div class="mt-1 text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">confidence</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between text-sm font-bold text-slate-700 dark:text-slate-200">
                            <span>Tingkat Keyakinan</span>
                            <span>{{ number_format($confidencePercent, 2) }}%</span>
                        </div>
                        <div class="mt-3 h-3 overflow-hidden rounded-full bg-slate-200/80 dark:bg-white/10">
                            <div id="cfBar" class="h-full w-0 rounded-full bg-gradient-to-r from-teal-500 via-sky-400 to-indigo-400 transition-all duration-1000 ease-out"></div>
                        </div>
                        <p class="mt-3 text-xs font-semibold text-slate-500 dark:text-slate-400">CF {{ $diagnosis->cf_value }} • {{ $diagnosis->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">CF breakdown</p>
                            <h3 class="mt-1 text-xl font-bold text-slate-950 dark:text-white">Perbandingan kategori</h3>
                        </div>
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-50 text-sky-700 dark:bg-sky-400/10 dark:text-sky-200">
                            <i data-lucide="bar-chart-3" class="h-5 w-5"></i>
                        </span>
                    </div>
                    <div class="mt-6 h-72">
                        <canvas id="cfChart" class="h-full w-full"></canvas>
                    </div>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Detail gejala</p>
                            <h3 class="mt-1 text-xl font-bold text-slate-950 dark:text-white">Kategori terpilih</h3>
                        </div>
                        <i data-lucide="clipboard-list" class="h-6 w-6 text-teal-600 dark:text-teal-300"></i>
                    </div>

                    <div class="mt-5 space-y-3">
                        @foreach ($diagnosis->details as $detail)
                            <div class="rounded-[1.5rem] border border-slate-200 bg-white/70 p-4 dark:border-white/10 dark:bg-white/5">
                                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wide text-teal-700 dark:text-teal-300">{{ $detail->symptom->code ?? '-' }}</p>
                                        <h4 class="mt-1 text-sm font-bold text-slate-950 dark:text-white">{{ $detail->symptom->name ?? '-' }}</h4>
                                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $detail->user_answer }}</p>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2 text-center">
                                        <div class="rounded-2xl bg-slate-100 px-3 py-2 dark:bg-white/10">
                                            <p class="text-[0.65rem] font-bold uppercase text-slate-500 dark:text-slate-400">Pakar</p>
                                            <p class="text-sm font-bold">{{ number_format((float) $detail->expert_cf, 2) }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-slate-100 px-3 py-2 dark:bg-white/10">
                                            <p class="text-[0.65rem] font-bold uppercase text-slate-500 dark:text-slate-400">User</p>
                                            <p class="text-sm font-bold">{{ number_format((float) $detail->user_cf, 2) }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-teal-50 px-3 py-2 text-teal-700 dark:bg-teal-400/10 dark:text-teal-200">
                                            <p class="text-[0.65rem] font-bold uppercase">CF</p>
                                            <p class="text-sm font-bold">{{ number_format((float) $detail->cf_he, 4) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Care plan</p>
                                <h3 class="mt-1 text-xl font-bold text-slate-950 dark:text-white">Rekomendasi</h3>
                            </div>
                            <i data-lucide="heart-handshake" class="h-6 w-6 text-teal-600 dark:text-teal-300"></i>
                        </div>

                        <div class="mt-5 space-y-3">
                            @forelse ($recommendations as $rec)
                                <div class="rounded-[1.5rem] border border-teal-100 bg-teal-50/70 p-4 dark:border-teal-400/20 dark:bg-teal-400/10">
                                    <h4 class="text-sm font-bold text-slate-950 dark:text-white">{{ $rec->title }}</h4>
                                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $rec->content }}</p>
                                </div>
                            @empty
                                <div class="rounded-[1.5rem] border border-slate-200 bg-white/70 p-4 text-sm text-slate-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-400">
                                    Belum ada rekomendasi untuk kategori ini.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-amber-200/70 bg-amber-50/80 p-5 text-sm leading-6 text-amber-900 shadow-sm backdrop-blur-xl dark:border-amber-300/20 dark:bg-amber-300/10 dark:text-amber-100">
                        <div class="flex gap-3">
                            <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0"></i>
                            <p>Hasil ini adalah skrining awal berbasis sistem pakar dan tidak menggantikan konsultasi profesional.</p>
                        </div>
                    </div>
                </aside>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
        (() => {
            const target = {{ (float) $confidencePercent }};
            const bar = document.getElementById('cfBar');
            if (bar) {
                requestAnimationFrame(() => {
                    bar.style.width = `${Math.max(0, Math.min(100, target))}%`;
                });
            }

            const chart = document.getElementById('cfChart');
            if (!chart || !window.Chart) {
                return;
            }

            new Chart(chart, {
                type: 'bar',
                data: {
                    labels: @js($chartLabels),
                    datasets: [{
                        label: 'Persentase CF',
                        data: @js($chartValues),
                        borderRadius: 14,
                        borderSkipped: false,
                        backgroundColor: ['#0d9488', '#38bdf8', '#818cf8', '#f59e0b', '#fb7185'],
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (context) => `${context.parsed.y}%`,
                            },
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: { color: 'rgba(148, 163, 184, 0.18)' },
                            ticks: { callback: (value) => `${value}%` },
                        },
                        x: {
                            grid: { display: false },
                        },
                    },
                },
            });
        })();
    </script>
</x-app-layout>
