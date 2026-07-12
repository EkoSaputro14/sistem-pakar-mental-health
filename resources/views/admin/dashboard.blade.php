<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Overview</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Dashboard Admin
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Stats Cards -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Stat 1: Total Mahasiswa -->
                <div class="overflow-hidden rounded-[2rem] border border-white/75 bg-white/80 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-xl transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Total Mahasiswa</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-950 dark:text-white">{{ number_format($totalMahasiswa) }}</h3>
                        </div>
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-400/10 dark:text-indigo-300">
                            <i data-lucide="users" class="h-6 w-6"></i>
                        </span>
                    </div>
                </div>

                <!-- Stat 2: Total Diagnosis -->
                <div class="overflow-hidden rounded-[2rem] border border-white/75 bg-white/80 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-xl transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Total Diagnosis</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-950 dark:text-white">{{ number_format($totalDiagnoses) }}</h3>
                        </div>
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-400/10 dark:text-teal-300">
                            <i data-lucide="clipboard-check" class="h-6 w-6"></i>
                        </span>
                    </div>
                </div>

                <!-- Stat 3: Kategori Depresi -->
                <div class="overflow-hidden rounded-[2rem] border border-white/75 bg-white/80 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-xl transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Kategori Depresi</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-950 dark:text-white">{{ $depressions->count() }}</h3>
                        </div>
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-400/10 dark:text-amber-300">
                            <i data-lucide="brain-circuit" class="h-6 w-6"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Chart & Summary Split -->
            <div class="grid gap-6 lg:grid-cols-[1.4fr_0.6fr]">
                <!-- Chart Card -->
                <div class="rounded-[2rem] border border-white/75 bg-white/80 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-950 dark:text-white">Statistik Diagnosis per Kategori</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Distribusi diagnosis kesehatan mental mahasiswa</p>
                        </div>
                        <span class="grid h-10 w-10 place-items-center rounded-2xl bg-sky-50 text-sky-600 dark:bg-sky-400/10 dark:text-sky-300">
                            <i data-lucide="bar-chart-3" class="h-5 w-5"></i>
                        </span>
                    </div>
                    <div class="mt-6 h-[18rem]">
                        <canvas id="diagChart" class="h-full w-full"></canvas>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="rounded-[2rem] border border-white/75 bg-white/80 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-950 dark:text-white">Ringkasan</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Total per tingkat severity</p>
                        </div>
                        <span class="grid h-10 w-10 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-400/10 dark:text-teal-300">
                            <i data-lucide="activity" class="h-5 w-5"></i>
                        </span>
                    </div>
                    <div class="mt-6 space-y-3.5">
                        @foreach ($counts as $code => $count)
                            @php
                                $badgeStyle = match($code) {
                                    'D1' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20',
                                    'D2' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/20',
                                    'D3' => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-500/10 dark:text-rose-300 dark:border-rose-500/20',
                                    default => 'bg-slate-50 text-slate-700 border-slate-200 dark:bg-slate-500/10 dark:text-slate-300 dark:border-slate-500/20'
                                };
                                $depressionName = match($code) {
                                    'D1' => 'Mild Depression',
                                    'D2' => 'Moderate Depression',
                                    'D3' => 'Severe Depression',
                                    default => 'Diagnosis'
                                };
                            @endphp
                            <div class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50/50 p-4 transition hover:bg-slate-100/50 dark:border-white/5 dark:bg-white/5 dark:hover:bg-white/10">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $badgeStyle }}">
                                        {{ $code }}
                                    </span>
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $depressionName }}</span>
                                </div>
                                <span class="text-base font-black text-slate-900 dark:text-white">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (() => {
            const ctx = document.getElementById('diagChart');
            if (!ctx) return;

            const labels = @json(array_keys($counts->toArray()));
            const data = @json(array_values($counts->toArray()));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Jumlah Diagnosis',
                        data,
                        borderRadius: 14,
                        borderSkipped: false,
                        backgroundColor: ['#10b981', '#f59e0b', '#f43f5e'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(148, 163, 184, 0.12)' },
                            ticks: { precision: 0 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        })();
    </script>
</x-app-layout>
