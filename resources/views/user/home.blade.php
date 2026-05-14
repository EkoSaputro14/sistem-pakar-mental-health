<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Mental wellness dashboard</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Ruang tenang untuk memahami kondisi Anda
                </h2>
            </div>
            <a href="{{ route('user.diagnosis') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                <i data-lucide="sparkles" class="h-4 w-4"></i>
                Mulai skrining
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="grid gap-6 lg:grid-cols-[1.45fr_0.55fr]">
                <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                    <div class="grid gap-8 lg:grid-cols-[1fr_18rem] lg:items-center">
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
                                <i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
                                Skrining awal berbasis Certainty Factor
                            </div>
                            <h1 class="mt-5 max-w-2xl text-4xl font-bold tracking-tight text-slate-950 dark:text-white sm:text-5xl">
                                Cek kesehatan mental dengan alur yang lembut dan privat.
                            </h1>
                            <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600 dark:text-slate-300">
                                Jawab gejala secara bertahap, lihat persentase keyakinan, lalu baca rekomendasi yang mudah dipahami. Hasil bersifat edukatif dan bukan pengganti diagnosis profesional.
                            </p>

                            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('user.diagnosis') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-teal-700 dark:bg-white dark:text-slate-950 dark:hover:bg-teal-100">
                                    <i data-lucide="clipboard-check" class="h-4 w-4"></i>
                                    Mulai diagnosis
                                </a>
                                <a href="{{ route('user.about') }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white/70 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                                    <i data-lucide="book-open" class="h-4 w-4"></i>
                                    Pelajari depresi
                                </a>
                            </div>
                        </div>

                        <div class="rounded-[1.75rem] border border-white/70 bg-gradient-to-br from-teal-50 via-white to-sky-50 p-5 shadow-inner dark:border-white/10 dark:from-teal-950/30 dark:via-slate-900/60 dark:to-sky-950/30">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Mood balance</p>
                                    <p class="mt-1 text-2xl font-bold text-slate-950 dark:text-white">72%</p>
                                </div>
                                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-white text-teal-600 shadow-sm dark:bg-white/10 dark:text-teal-200">
                                    <i data-lucide="activity" class="h-5 w-5"></i>
                                </span>
                            </div>
                            <div class="mt-6 space-y-4">
                                @foreach ([['Tidur', 78], ['Fokus', 64], ['Energi', 58]] as [$label, $value])
                                    <div>
                                        <div class="flex items-center justify-between text-xs font-semibold text-slate-600 dark:text-slate-300">
                                            <span>{{ $label }}</span>
                                            <span>{{ $value }}%</span>
                                        </div>
                                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200/80 dark:bg-white/10">
                                            <div class="h-full rounded-full bg-gradient-to-r from-teal-500 to-sky-400" style="width: {{ $value }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="rounded-[2rem] border border-white/70 bg-slate-950 p-6 text-white shadow-xl shadow-slate-300/40 dark:border-white/10 dark:bg-white/5 dark:shadow-black/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-teal-200">Sesi berikutnya</p>
                            <h3 class="mt-1 text-2xl font-bold">4 langkah</h3>
                        </div>
                        <i data-lucide="route" class="h-8 w-8 text-teal-200"></i>
                    </div>
                    <div class="mt-8 space-y-4">
                        @foreach (['Pilih gejala', 'Hitung CF', 'Lihat persentase', 'Baca rekomendasi'] as $index => $step)
                            <div class="flex items-center gap-3">
                                <span class="grid h-8 w-8 place-items-center rounded-full bg-white/10 text-xs font-bold text-teal-100">{{ $index + 1 }}</span>
                                <span class="text-sm text-slate-200">{{ $step }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8 rounded-2xl border border-amber-200/20 bg-amber-200/10 p-4 text-sm leading-6 text-amber-50">
                        Jika Anda merasa tidak aman atau mengalami krisis, segera hubungi layanan darurat setempat atau tenaga profesional.
                    </div>
                </aside>
            </section>

            <section class="grid gap-4 md:grid-cols-3">
                @foreach ([
                    ['heart-handshake', 'Privat', 'Jawaban tersimpan pada akun Anda dan dapat dilihat kembali di riwayat.'],
                    ['brain', 'Terarah', 'Pertanyaan bertahap membantu Anda menjawab tanpa merasa terburu-buru.'],
                    ['line-chart', 'Terukur', 'Hasil ditampilkan dalam persentase, chart, dan rekomendasi praktis.'],
                ] as [$icon, $title, $copy])
                    <div class="rounded-[1.5rem] border border-white/70 bg-white/70 p-5 shadow-sm backdrop-blur-xl transition hover:-translate-y-1 hover:shadow-lg dark:border-white/10 dark:bg-white/5">
                        <div class="grid h-11 w-11 place-items-center rounded-2xl bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-200">
                            <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
                        </div>
                        <h3 class="mt-4 text-base font-bold text-slate-950 dark:text-white">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $copy }}</p>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
</x-app-layout>
