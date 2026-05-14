<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Mahasiswa</div>
                    <div class="mt-2 text-3xl font-semibold">{{ number_format($totalUsers) }}</div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Diagnosis</div>
                    <div class="mt-2 text-3xl font-semibold">{{ number_format($totalDiagnoses) }}</div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Kategori Depresi</div>
                    <div class="mt-2 text-3xl font-semibold">{{ $depressions->count() }}</div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-semibold">Statistik Diagnosis per Kategori</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Chart.js</div>
                    </div>
                    <div class="mt-4">
                        <canvas id="diagChart" height="120"></canvas>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <div class="text-sm font-semibold">Ringkasan</div>
                    <div class="mt-4 space-y-3">
                        @foreach ($counts as $code => $count)
                            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-800 dark:bg-gray-950/30">
                                <div class="text-sm font-medium">{{ $code }}</div>
                                <div class="text-sm">{{ $count }}</div>
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
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })();
    </script>
</x-app-layout>
