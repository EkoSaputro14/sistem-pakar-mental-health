<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
                <!-- Left Content -->
                <div class="space-y-6 lg:col-span-7">
                    <div class="inline-flex items-center gap-2 rounded-full border border-teal-100 bg-teal-50 px-3.5 py-1.5 text-xs font-bold text-teal-700 dark:border-teal-400/20 dark:bg-teal-400/10 dark:text-teal-200">
                        <i data-lucide="shield-check" class="h-4 w-4"></i>
                        Skrining Berbasis Certainty Factor & Expert Knowledge
                    </div>
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-5xl lg:text-6xl leading-tight">
                        Deteksi Dini Kesehatan Mental <span class="bg-gradient-to-r from-teal-600 to-sky-500 bg-clip-text text-transparent">Mahasiswa</span>
                    </h1>
                    <p class="text-base sm:text-lg leading-relaxed text-slate-600 dark:text-slate-300 max-w-2xl">
                        MindCare hadir sebagai sistem pakar penilai tingkat depresi mandiri secara privat, terarah, dan teruji secara klinis berdasarkan model pakar psikologi. Ketahui kondisi psikologis Anda sebelum berdampak pada akademis.
                    </p>

                    <div class="flex flex-col gap-3.5 sm:flex-row pt-2">
                        <a href="{{ route('user.diagnosis') }}" class="group inline-flex items-center justify-center gap-2.5 rounded-2xl bg-teal-600 px-7 py-4 text-sm font-bold text-white shadow-lg shadow-teal-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-teal-700 hover:shadow-xl hover:shadow-teal-600/30">
                            <i data-lucide="clipboard-list" class="h-4 w-4 transition-transform duration-300 group-hover:scale-110"></i>
                            Mulai Diagnosis Sekarang
                        </a>
                        <a href="{{ route('user.about') }}" class="group inline-flex items-center justify-center gap-2.5 rounded-2xl border border-slate-200 bg-white/80 px-7 py-4 text-sm font-bold text-slate-700 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-white hover:shadow-md hover:border-slate-300">
                            <i data-lucide="book-open" class="h-4 w-4 transition-transform duration-300 group-hover:scale-110"></i>
                            Pelajari Tingkat Depresi
                        </a>
                    </div>

                    <!-- Client Trust Mock Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200/60 max-w-lg">
                        <div class="group rounded-2xl border border-slate-100 bg-white/80 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-teal-200">
                            <span class="grid h-9 w-9 place-items-center rounded-xl bg-teal-50 text-teal-600 transition group-hover:bg-teal-100">
                                <i data-lucide="shield-check" class="h-4 w-4"></i>
                            </span>
                            <p class="mt-3 text-xl font-extrabold text-slate-900">100%</p>
                            <p class="mt-0.5 text-xs text-slate-500 font-medium">Privat & Aman</p>
                        </div>
                        <div class="group rounded-2xl border border-slate-100 bg-white/80 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-sky-200">
                            <span class="grid h-9 w-9 place-items-center rounded-xl bg-sky-50 text-sky-600 transition group-hover:bg-sky-100">
                                <i data-lucide="list-checks" class="h-4 w-4"></i>
                            </span>
                            <p class="mt-3 text-xl font-extrabold text-slate-900">9+</p>
                            <p class="mt-0.5 text-xs text-slate-500 font-medium">Gejala Klinis</p>
                        </div>
                        <div class="group rounded-2xl border border-slate-100 bg-white/80 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-200">
                            <span class="grid h-9 w-9 place-items-center rounded-xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-100">
                                <i data-lucide="brain-circuit" class="h-4 w-4"></i>
                            </span>
                            <p class="mt-3 text-xl font-extrabold text-slate-900">CF</p>
                            <p class="mt-0.5 text-xs text-slate-500 font-medium">Terukur & Akurat</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Illustration) -->
                <div class="relative lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <!-- Decorative glow backdrops -->
                        <div class="absolute -inset-4 rounded-full bg-teal-500/10 blur-2xl dark:bg-teal-400/5"></div>
                        
                        <!-- Main Illustration -->
                        <div class="overflow-hidden rounded-[2.5rem] border border-white bg-white/30 p-4 shadow-2xl backdrop-blur-xl dark:border-white/10 dark:bg-white/5">
                            <img src="{{ asset('images/mental_health_landing.png') }}" alt="Mental Health Well-being" class="rounded-[2rem] w-full object-cover shadow-sm bg-teal-50/50 dark:bg-slate-900/50" />
                        </div>

                        <!-- Floating Micro Card -->
                        <div class="absolute -bottom-6 -left-6 rounded-2xl border border-white/60 bg-white/90 p-4 shadow-xl dark:border-white/10 dark:bg-slate-900/90 flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-rose-50 text-rose-500 dark:bg-rose-500/10">
                                <i data-lucide="heart" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase">Kesehatan Mental</p>
                                <p class="text-sm font-extrabold text-slate-900 dark:text-white">Self-Care Rutin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Educational & Why Screening Section -->
    <div class="py-12 sm:py-16 bg-slate-50/50 dark:bg-slate-950/20 border-y border-slate-100 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <p class="text-sm font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest">Pentingnya Deteksi Dini</p>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                    Mengapa Skrining Kesehatan Mental Sangat Penting Bagi Mahasiswa?
                </h2>
                <p class="text-base text-slate-600 dark:text-slate-300">
                    Tekanan akademis, beban tugas akhir, dan transisi kehidupan perkuliahan sering kali memicu stres berat yang berkembang menjadi depresi tanpa disadari.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3 mt-12">
                <div class="group rounded-[2rem] border border-slate-100 bg-white/80 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-teal-200 flex flex-col justify-between">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 transition group-hover:bg-teal-100 group-hover:scale-105">
                        <i data-lucide="graduation-cap" class="h-6 w-6"></i>
                    </span>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-900">Tekanan Akademis Tinggi</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Tuntutan indeks prestasi, tenggat waktu tugas, dan kekhawatiran masa depan pasca-kampus memicu kecemasan konstan.
                        </p>
                    </div>
                </div>

                <div class="group rounded-[2rem] border border-slate-100 bg-white/80 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-sky-200 flex flex-col justify-between">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-sky-50 text-sky-600 transition group-hover:bg-sky-100 group-hover:scale-105">
                        <i data-lucide="users" class="h-6 w-6"></i>
                    </span>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-900">Perubahan Lingkungan Sosial</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Hidup merantau jauh dari keluarga dan proses adaptasi pertemanan baru berpotensi memicu perasaan kesepian yang intens.
                        </p>
                    </div>
                </div>

                <div class="group rounded-[2rem] border border-slate-100 bg-white/80 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-amber-200 flex flex-col justify-between">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-amber-50 text-amber-600 transition group-hover:bg-amber-100 group-hover:scale-105">
                        <i data-lucide="sparkles" class="h-6 w-6"></i>
                    </span>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-slate-900">Pencegahan Sejak Dini</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Melakukan skrining awal membantu Anda mengenali gejala depresi lebih awal sehingga penanganan mandiri atau profesional dapat segera berjalan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Certainty Factor Expert System Workflow -->
    <div class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <p class="text-sm font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest">Sistem Pakar Logika</p>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                    Bagaimana Sistem Pakar Menghitung Kondisi Anda?
                </h2>
                <p class="text-base text-slate-600 dark:text-slate-300">
                    Sistem ini mengadopsi model Certainty Factor (CF) untuk mengukur tingkat keyakinan hipotesis berdasarkan akumulasi input gejala Anda.
                </p>
            </div>

            <div class="grid gap-6 mt-12 md:grid-cols-4">
                @php
                    $steps = [
                        ['clipboard-check', 'Input Gejala', 'Anda memilih gejala depresi yang dirasakan beserta tingkat keyakinan (Mungkin s/d Sangat Yakin).'],
                        ['shield-alert', 'CF Pakar & User', 'Sistem mengalikan bobot keparahan gejala dari Pakar Psikolog dengan bobot keyakinan dari Anda.'],
                        ['calculator', 'Kombinasi CF', 'Nilai keyakinan dari beberapa gejala digabungkan secara kumulatif menggunakan rumus Certainty Factor.'],
                        ['award', 'Hasil & Rekomendasi', 'Diagnosis akhir disajikan dalam bentuk persentase probabilitas depresi beserta saran pemulihan.']
                    ];
                @endphp
                @foreach ($steps as $index => $step)
                    <div class="relative rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-lg backdrop-blur-xl dark:border-white/10 dark:bg-white/5 space-y-4">
                        <span class="absolute -top-4 -right-4 grid h-10 w-10 place-items-center rounded-full bg-slate-900 text-white font-extrabold text-sm dark:bg-white dark:text-slate-950">
                            0{{ $index + 1 }}
                        </span>
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="{{ $step[0] }}" class="h-6 w-6"></i>
                        </span>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900 dark:text-white">{{ $step[1] }}</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">{{ $step[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Educational: Depression severity guides -->
    <div class="py-12 sm:py-16 bg-slate-50/50 dark:bg-slate-950/20 border-y border-slate-100 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <p class="text-sm font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest">Panduan Edukasi</p>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                    Mengenal Kategori Keparahan Depresi
                </h2>
                <p class="text-base text-slate-600 dark:text-slate-300">
                    Berikut adalah kategori klasifikasi tingkat depresi berdasarkan standar psikologis yang digunakan dalam sistem pakar ini.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3 mt-12">
                <!-- D1 -->
                <div class="rounded-[2.2rem] border border-emerald-100 bg-white p-6 shadow-xl dark:border-emerald-500/10 dark:bg-slate-900/40">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                            Kode: D1
                        </span>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Depresi Ringan</h3>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-4 leading-relaxed">
                        Ditandai dengan perasaan murung, lelah berlebih, dan hilangnya ketertarikan sementara pada hobi. Aktivitas sehari-hari masih bisa dijalankan namun membutuhkan usaha lebih besar dari biasanya.
                    </p>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                        <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wide">Rekomendasi Utama</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Istirahat cukup, olahraga ringan, bercerita ke teman dekat, dan latihan pernapasan/mindfulness.</p>
                    </div>
                </div>

                <!-- D2 -->
                <div class="rounded-[2.2rem] border border-amber-100 bg-white p-6 shadow-xl dark:border-amber-500/10 dark:bg-slate-900/40">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                            Kode: D2
                        </span>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Depresi Sedang</h3>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-4 leading-relaxed">
                        Mengalami gangguan konsentrasi berat, perubahan nafsu makan ekstrem, sulit tidur (insomnia), dan penurunan performa akademis secara signifikan. Aktivitas sehari-hari mulai terasa sangat berat.
                    </p>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                        <p class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wide">Rekomendasi Utama</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Konseling dengan konselor sebaya, manajer akademik, atau berkonsultasi dengan psikolog klinis.</p>
                    </div>
                </div>

                <!-- D3 -->
                <div class="rounded-[2.2rem] border border-rose-100 bg-white p-6 shadow-xl dark:border-rose-500/10 dark:bg-slate-900/40">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-700 dark:bg-rose-500/10 dark:text-rose-300">
                            Kode: D3
                        </span>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Depresi Berat</h3>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-4 leading-relaxed">
                        Merasa putus asa secara menyeluruh, menarik diri total dari lingkungan sosial, tidak mampu melakukan perawatan diri dasar, hingga munculnya pikiran melukai diri (self-harm).
                    </p>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                        <p class="text-xs font-bold text-rose-600 dark:text-rose-400 uppercase tracking-wide">Rekomendasi Utama</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Wajib berkonsultasi segera dengan Psikiater atau Psikolog Klinis profesional untuk penanganan intensif.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-12 sm:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-3">
                <p class="text-sm font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest">Informasi Tambahan</p>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                    Pertanyaan yang Sering Diajukan (FAQ)
                </h2>
            </div>

            <div class="mt-10 space-y-4" x-data="{ active: null }">
                @php
                    $faqs = [
                        [
                            'Apakah diagnosis dari sistem pakar ini 100% akurat?',
                            'Hasil diagnosis didasarkan pada kalkulasi Certainty Factor menggunakan basis pengetahuan yang dirancang sesuai pakar psikologi. Namun, hasil skrining ini bersifat edukatif dan deteksi dini saja. Sistem ini bukan pengganti diagnosis medis/klinis resmi dari psikolog atau psikiater profesional.'
                        ],
                        [
                            'Bagaimana Certainty Factor (CF) bekerja di sistem ini?',
                            'Metode Certainty Factor menggabungkan derajat keyakinan pakar terhadap suatu gejala (expert CF) dengan derajat keyakinan yang dirasakan dan dipilih pengguna (user CF). Menggunakan formula kombinasi CF, akumulasi gejala yang Anda pilih dihitung secara matematis untuk menentukan persentase keyakinan akhir terhadap tingkat depresi Anda.'
                        ],
                        [
                            'Apakah data hasil diagnosis saya aman dan rahasia?',
                            'Ya, privasi Anda adalah prioritas kami. Semua jawaban dan hasil diagnosis tersimpan dengan aman pada akun Anda dan hanya dapat diakses oleh Anda sendiri melalui menu Riwayat Diagnosis di portal mahasiswa.'
                        ]
                    ];
                @endphp

                @foreach ($faqs as $i => $faq)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-white/5 dark:bg-white/5">
                        <button 
                            type="button" 
                            class="flex w-full items-center justify-between p-5 text-left font-bold text-slate-900 dark:text-white transition hover:bg-slate-50 dark:hover:bg-white/5"
                            @click="active === {{ $i }} ? active = null : active = {{ $i }}"
                        >
                            <span>{{ $faq[0] }}</span>
                            <span class="ml-4 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-300">
                                <i data-lucide="chevron-down" class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': active === {{ $i }} }"></i>
                            </span>
                        </button>
                        <div 
                            class="transition-all duration-300 ease-in-out" 
                            x-show="active === {{ $i }}" 
                            x-collapse
                        >
                            <div class="p-5 border-t border-slate-100 text-sm text-slate-600 dark:border-white/5 dark:text-slate-300 leading-relaxed bg-slate-50/50 dark:bg-slate-900/30">
                                {{ $faq[1] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-slate-200/60 bg-white/70 backdrop-blur-xl dark:border-white/5 dark:bg-slate-950/70 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid gap-8 md:grid-cols-4">
            <!-- Col 1 -->
            <div class="space-y-4 md:col-span-2">
                <a href="{{ route('user.home') }}" class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-teal-500 text-white shadow-lg shadow-teal-500/20">
                        <i data-lucide="heart-pulse" class="h-4.5 w-4.5"></i>
                    </span>
                    <span class="text-sm font-bold tracking-tight text-slate-950 dark:text-white">MindCare Portal</span>
                </a>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed max-w-sm">
                    <strong>Pernyataan Batas Tanggung Jawab:</strong> MindCare adalah sistem pakar edukasi dan deteksi awal kesehatan mental mahasiswa. Sistem ini tidak memberikan diagnosis medis mutlak. Jika Anda mengalami krisis mental atau pikiran melukai diri, segera hubungi layanan darurat setempat atau psikolog profesional.
                </p>
            </div>

            <!-- Col 2 -->
            <div>
                <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Akses Cepat</h4>
                <ul class="mt-4 space-y-2 text-xs text-slate-500 dark:text-slate-400">
                    <li><a href="{{ route('user.home') }}" class="hover:text-teal-600">Beranda</a></li>
                    <li><a href="{{ route('user.about') }}" class="hover:text-teal-600">Tentang Depresi</a></li>
                    <li><a href="{{ route('user.diagnosis') }}" class="hover:text-teal-600">Skrining Diagnosis</a></li>
                    @auth
                        <li><a href="{{ route('user.history') }}" class="hover:text-teal-600">Riwayat Skrining</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Col 3 -->
            <div>
                <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Metode Sistem</h4>
                <ul class="mt-4 space-y-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
                    <li>Certainty Factor Algorithm</li>
                    <li>Forward Chaining Rules</li>
                    <li>Kepakaran Psikolog</li>
                    <li class="mt-4 text-[10px] text-slate-400 dark:text-slate-500 font-normal">© {{ date('Y') }} MindCare. All rights reserved.</li>
                </ul>
            </div>
        </div>
    </footer>
</x-app-layout>
