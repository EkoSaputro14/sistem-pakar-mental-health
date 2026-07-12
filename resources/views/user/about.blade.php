<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Edukasi & Informasi</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Tentang Depresi
                </h2>
            </div>
            <a href="{{ route('user.diagnosis') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                <i data-lucide="sparkles" class="h-4 w-4"></i>
                Mulai skrining
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">
            <!-- Hero Card -->
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <div class="grid gap-8 lg:grid-cols-[1fr_20rem] lg:items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
                            <i data-lucide="info" class="h-3.5 w-3.5"></i>
                            Apa itu depresi?
                        </div>
                        <h1 class="mt-5 text-3xl font-bold tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                            Memahami Depresi Lebih Dekat
                        </h1>
                        <p class="mt-4 text-base leading-7 text-slate-600 dark:text-slate-300">
                            Depresi adalah kondisi kesehatan mental yang ditandai dengan suasana hati sedih berkepanjangan dan/atau kehilangan minat, yang dapat disertai perubahan tidur, nafsu makan, energi, konsentrasi, dan fungsi sosial. Ini bukan sekadar kesedihan sementara, melainkan kondisi medis yang memerlukan pemahaman dan penanganan yang tepat.
                        </p>
                    </div>

                    <div class="rounded-[1.75rem] border border-white/70 bg-gradient-to-br from-teal-50 via-white to-sky-50 p-6 shadow-inner dark:border-white/10 dark:from-teal-950/30 dark:via-slate-900/60 dark:to-sky-950/30">
                        <div class="flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center rounded-2xl bg-teal-500 text-white shadow-md">
                                <i data-lucide="brain-circuit" class="h-5 w-5"></i>
                            </span>
                            <span class="text-sm font-bold text-slate-950 dark:text-white">Sistem Pakar CF</span>
                        </div>
                        <p class="mt-4 text-sm leading-6 text-slate-600 dark:text-slate-300">
                            Sistem ini menggunakan metode <span class="font-bold text-teal-700 dark:text-teal-300">Certainty Factor</span> untuk menghitung tingkat keyakinan berdasarkan kombinasi nilai CF pakar dan jawaban gejala yang Anda rasakan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Detail Cards -->
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Card 1: Symptoms Warning -->
                <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-amber-50 text-amber-700 dark:bg-amber-400/10 dark:text-amber-200">
                            <i data-lucide="shield-alert" class="h-5 w-5"></i>
                        </span>
                        <h3 class="text-lg font-bold text-slate-950 dark:text-white">Kapan Perlu Mencari Bantuan?</h3>
                    </div>
                    <ul class="mt-6 space-y-4">
                        @foreach ([
                            'Gejala kesedihan atau kehilangan minat berlangsung terus-menerus selama lebih dari 2 minggu.',
                            'Mengganggu aktivitas harian secara signifikan (seperti belajar, bekerja, atau bersosialisasi).',
                            'Muncul pikiran untuk menyakiti diri sendiri (self-harm) atau merasa tidak aman.'
                        ] as $index => $item)
                            <li class="flex gap-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                <span class="grid h-6 w-6 shrink-0 place-items-center rounded-full bg-slate-100 text-xs font-bold text-slate-700 dark:bg-white/10 dark:text-slate-200">{{ $index + 1 }}</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Card 2: Educational disclaimer -->
                <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-200">
                            <i data-lucide="help-circle" class="h-5 w-5"></i>
                        </span>
                        <h3 class="text-lg font-bold text-slate-950 dark:text-white">Batasan Hasil Skrining</h3>
                    </div>
                    <p class="mt-6 text-sm leading-7 text-slate-600 dark:text-slate-300">
                        Hasil dari sistem pakar Certainty Factor ini bersifat edukatif dan ditujukan sebagai skrining awal (skrining mandiri). Hasil ini tidak dimaksudkan untuk menggantikan diagnosis medis, psikologis, atau psikiatris profesional. 
                    </p>
                    <div class="mt-6 rounded-2xl border border-amber-200/20 bg-amber-200/10 p-4 text-xs leading-5 text-amber-800 dark:text-amber-200">
                        <strong>Catatan:</strong> Jika Anda merasa tertekan secara signifikan atau berada dalam kondisi darurat, silakan hubungi psikolog, psikiater, atau layanan bantuan darurat terdekat.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
