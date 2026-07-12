<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Hasil Skrining</p>
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
        $circleValue = max(0, min(100, (float) $confidencePercent));
        $levelLabel = match(true) {
            $confidencePercent >= 70 => 'Tinggi',
            $confidencePercent >= 40 => 'Sedang',
            default => 'Rendah',
        };
        $levelColor = match(true) {
            $confidencePercent >= 70 => 'rose',
            $confidencePercent >= 40 => 'amber',
            default => 'emerald',
        };
    @endphp

    <div class="py-6 sm:py-10">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Hasil Utama -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div class="flex flex-col items-center text-center">
                    <span class="grid h-16 w-16 place-items-center rounded-3xl bg-teal-50 text-teal-600 dark:bg-teal-400/10 dark:text-teal-300 mb-4">
                        <i data-lucide="brain-circuit" class="h-8 w-8"></i>
                    </span>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Tingkat depresi Anda</p>
                    <h3 class="mt-2 text-3xl font-black tracking-tight text-slate-950 dark:text-white">
                        {{ $diagnosis->depression?->name ?? '-' }}
                    </h3>

                    <div class="mt-6 w-full max-w-xs">
                        <div class="flex items-center justify-between text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">
                            <span>Tingkat Keyakinan</span>
                            <span>{{ number_format($confidencePercent, 1) }}%</span>
                        </div>
                        <div class="h-4 overflow-hidden rounded-full bg-slate-200/80 dark:bg-white/10">
                            <div id="cfBar" class="h-full w-0 rounded-full bg-gradient-to-r from-teal-500 via-sky-400 to-indigo-400 transition-all duration-1000 ease-out"></div>
                        </div>
                    </div>

                    @if ($diagnosis->identitas !== '-')
                        <p class="mt-4 text-xs font-semibold text-slate-400">{{ $diagnosis->identitas }}</p>
                    @endif
                    <p class="mt-1 text-xs text-slate-400">{{ $diagnosis->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <!-- Gejala yang Anda Jawab -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="grid h-10 w-10 place-items-center rounded-2xl bg-sky-50 text-sky-600 dark:bg-sky-400/10 dark:text-sky-300">
                        <i data-lucide="clipboard-list" class="h-5 w-5"></i>
                    </span>
                    <h3 class="text-lg font-bold text-slate-950 dark:text-white">Gejala yang Anda Jawab</h3>
                </div>

                <div class="space-y-2">
                    @foreach ($diagnosis->details as $detail)
                        @php
                            $answerColor = match($detail->user_answer) {
                                'Tidak Pernah' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20',
                                'Kadang-kadang' => 'bg-sky-50 text-sky-700 border-sky-200 dark:bg-sky-500/10 dark:text-sky-300 dark:border-sky-500/20',
                                'Sering' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:border-amber-500/20',
                                'Selalu' => 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-500/10 dark:text-rose-300 dark:border-rose-500/20',
                                default => 'bg-slate-50 text-slate-600 border-slate-200 dark:bg-white/5 dark:text-slate-400 dark:border-white/10',
                            };
                        @endphp
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-100 bg-white/80 px-4 py-3 dark:border-white/10 dark:bg-white/5">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $detail->symptom->name ?? '-' }}</p>
                            </div>
                            <span class="inline-flex shrink-0 items-center rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $answerColor }}">
                                {{ $detail->user_answer }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Rekomendasi -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div class="flex items-center gap-3 mb-5">
                    <span class="grid h-10 w-10 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-400/10 dark:text-teal-300">
                        <i data-lucide="heart-handshake" class="h-5 w-5"></i>
                    </span>
                    <h3 class="text-lg font-bold text-slate-950 dark:text-white">Rekomendasi</h3>
                </div>

                <div class="space-y-3">
                    @forelse ($recommendations as $rec)
                        <div class="rounded-2xl border border-teal-100 bg-teal-50/70 p-5 dark:border-teal-400/20 dark:bg-teal-400/10">
                            <h4 class="text-base font-bold text-slate-950 dark:text-white">{{ $rec->title }}</h4>
                            <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $rec->content }}</p>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-slate-200 bg-white/70 p-5 text-sm text-slate-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-400">
                            Belum ada rekomendasi untuk kategori ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Disclaimer -->
            <div class="rounded-[2rem] border border-amber-200/70 bg-amber-50/80 p-5 text-sm leading-6 text-amber-900 shadow-sm dark:border-amber-300/20 dark:bg-amber-300/10 dark:text-amber-100">
                <div class="flex gap-3">
                    <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0"></i>
                    <p>Hasil ini adalah skrining awal berbasis sistem pakar dan <strong>bukan diagnosis medis</strong>. Silakan konsultasikan dengan profesional untuk penanganan lebih lanjut.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        (() => {
            const target = {{ (float) $confidencePercent }};
            const bar = document.getElementById('cfBar');
            if (bar) {
                requestAnimationFrame(() => {
                    bar.style.width = `${Math.max(0, Math.min(100, target))}%`;
                });
            }
        })();
    </script>

    <script>
        // Simpan diagnosis ID ke localStorage
        (() => {
            try {
                const id = {{ $diagnosis->id }};
                const key = 'mindcare_riwayat';
                let list = JSON.parse(localStorage.getItem(key) || '[]');
                if (!list.some(r => r.id === id)) {
                    list.unshift({
                        id: id,
                        date: '{{ $diagnosis->created_at->format("Y-m-d H:i") }}',
                        result: '{{ $diagnosis->depression?->code ?? "-" }}',
                        name: '{{ addslashes($diagnosis->depression?->name ?? "-") }}',
                        cf: {{ $diagnosis->cf_value }}
                    });
                    if (list.length > 50) list = list.slice(0, 50);
                    localStorage.setItem(key, JSON.stringify(list));
                }
            } catch(e) {}
        })();
    </script>
</x-app-layout>
