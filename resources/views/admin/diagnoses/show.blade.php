<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Detail Diagnosis</h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.diagnoses.pdf', $diagnosis) }}" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                    Export PDF
                </a>
                <button type="button" onclick="window.print()" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                    Print
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <div class="grid gap-4 md:grid-cols-3">
                    <div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Pengguna</div>
                        <div class="mt-1 font-semibold">{{ $diagnosis->user?->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">{{ $diagnosis->user?->email }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Tanggal</div>
                        <div class="mt-1 font-semibold">{{ $diagnosis->created_at->format('d M Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Hasil</div>
                        <div class="mt-1 font-semibold">{{ $diagnosis->depression?->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">{{ $diagnosis->depression?->code }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex items-end justify-between">
                        <div class="text-sm font-semibold">Tingkat Keyakinan</div>
                        <div class="text-2xl font-semibold text-sky-700 dark:text-sky-300">{{ number_format($confidencePercent, 2) }}%</div>
                    </div>
                    <div class="mt-2 h-3 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-800">
                        <div id="cfBar" class="h-full w-0 rounded-full bg-sky-600 transition-all duration-700"></div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">CF: {{ $diagnosis->cf_value }}</div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="text-sm font-semibold">Perbandingan Nilai CF per Kategori</div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-left text-gray-500 dark:text-gray-400">
                                    <tr>
                                        <th class="py-2">Kategori</th>
                                        <th class="py-2">Nilai CF</th>
                                        <th class="py-2">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach (($diagnosis->cf_breakdown ?? []) as $code => $cf)
                                        <tr>
                                            <td class="py-2 font-medium">{{ $code }}</td>
                                            <td class="py-2">{{ number_format((float) $cf, 4) }}</td>
                                            <td class="py-2">{{ number_format(((float) $cf) * 100, 2) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="text-sm font-semibold">Detail Jawaban Gejala</div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-left text-gray-500 dark:text-gray-400">
                                    <tr>
                                        <th class="py-2">Gejala</th>
                                        <th class="py-2">Jawaban</th>
                                        <th class="py-2">CF Pakar</th>
                                        <th class="py-2">CF User</th>
                                        <th class="py-2">CF(H,E)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach ($diagnosis->details as $detail)
                                        <tr>
                                            <td class="py-2">
                                                <div class="text-xs font-semibold text-sky-700 dark:text-sky-300">{{ $detail->symptom->code ?? '-' }}</div>
                                                <div class="font-medium">{{ $detail->symptom->name ?? '-' }}</div>
                                            </td>
                                            <td class="py-2">{{ $detail->user_answer }}</td>
                                            <td class="py-2">{{ number_format((float) $detail->expert_cf, 2) }}</td>
                                            <td class="py-2">{{ number_format((float) $detail->user_cf, 2) }}</td>
                                            <td class="py-2">{{ number_format((float) $detail->cf_he, 4) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                        <div class="text-sm font-semibold">Rekomendasi</div>
                        <div class="mt-3 space-y-3">
                            @forelse ($recommendations as $rec)
                                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950/30">
                                    <div class="text-sm font-semibold">{{ $rec->title }}</div>
                                    <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $rec->content }}</div>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500 dark:text-gray-400">Belum ada rekomendasi untuk kategori ini.</div>
                            @endforelse
                        </div>
                    </div>

                    <a href="{{ route('admin.diagnoses.index') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">Kembali ke Laporan</a>
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
