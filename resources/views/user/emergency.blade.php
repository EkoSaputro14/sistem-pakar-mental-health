<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Bantuan Segera</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Kontak Darurat & Layanan Krisis
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Warning Banner -->
            <div class="rounded-3xl border border-rose-200 bg-rose-50/50 p-6 dark:border-rose-500/10 dark:bg-rose-500/5 flex items-start gap-4">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-rose-100 text-rose-600 dark:bg-rose-500/20 dark:text-rose-400 shrink-0">
                    <i data-lucide="shield-alert" class="h-6 w-6"></i>
                </span>
                <div>
                    <h3 class="text-lg font-bold text-rose-900 dark:text-rose-400">Penting: Layanan Ini Bukan UGD Medis</h3>
                    <p class="text-sm text-rose-700 dark:text-rose-300/80 mt-1 leading-relaxed">
                        Jika Anda atau orang di sekitar Anda berada dalam bahaya fisik segera (seperti percobaan melukai diri sendiri atau situasi darurat medis lainnya), harap segera hubungi UGD rumah sakit terdekat atau panggil ambulans nasional di nomor <strong>112</strong>.
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Hotline 1 -->
                <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="phone" class="h-6 w-6"></i>
                        </span>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">Layanan SEJIWA</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Layanan Kesehatan Mental Nasional</p>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Layanan konsultasi psikologi resmi dari pemerintah Indonesia yang diinisiasi oleh Kemenkes dan BNPB untuk membantu masyarakat menghadapi tekanan psikologis.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                        <a href="tel:119" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-teal-600 py-3 text-sm font-bold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                            <i data-lucide="phone-call" class="h-4 w-4"></i>
                            Hubungi 119 (Ext 8)
                        </a>
                    </div>
                </div>

                <!-- Hotline 2 -->
                <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="message-circle" class="h-6 w-6"></i>
                        </span>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">LISA Suicide Helpline</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Love Inside Suicide Awareness</p>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Layanan pencegahan bunuh diri dan kesehatan mental berbasis komunitas di Indonesia yang melayani bantuan 24 jam penuh secara gratis dan privat.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                        <a href="tel:08113855472" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-teal-600 py-3 text-sm font-bold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                            <i data-lucide="phone-call" class="h-4 w-4"></i>
                            Hubungi 0811-3855-472
                        </a>
                    </div>
                </div>

                <!-- Hotline 3 -->
                <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400">
                            <i data-lucide="heart" class="h-6 w-6"></i>
                        </span>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">Layanan Konseling Kampus</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Layanan Akademik Mahasiswa</p>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Hubungi Unit Kegiatan Mahasiswa (UKM) konseling, dosen pembimbing akademik, atau Unit Pelayanan Bimbingan Konseling di Fakultas Anda untuk jadwal tatap muka.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                        <a href="https://wa.me/#" target="_blank" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-slate-950 py-3 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-teal-700 dark:bg-white dark:text-slate-950 dark:hover:bg-teal-100">
                            <i data-lucide="message-square" class="h-4 w-4"></i>
                            Hubungi Konselor Kampus
                        </a>
                    </div>
                </div>
            </div>

            <!-- Steps for crisis management -->
            <div class="overflow-hidden rounded-[2.5rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8 space-y-6">
                <div class="flex items-center gap-2 font-bold text-slate-950 dark:text-white">
                    <i data-lucide="heart-handshake" class="h-5 w-5 text-teal-600"></i>
                    <h3 class="text-lg">Apa yang Harus Dilakukan Saat Mengalami Krisis Emosional?</h3>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <div class="space-y-2">
                        <div class="text-2xl font-extrabold text-teal-600 dark:text-teal-400">1. Tarik Napas Dalam</div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Gunakan teknik 4-7-8 (tarik napas 4 detik, tahan 7 detik, embuskan 8 detik) untuk menurunkan kecemasan fisik secara cepat.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <div class="text-2xl font-extrabold text-teal-600 dark:text-teal-400">2. Hubungi Seseorang</div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Jangan memendam perasaan Anda sendirian. Hubungi teman dekat, keluarga, atau nomor hotline krisis di atas.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <div class="text-2xl font-extrabold text-teal-600 dark:text-teal-400">3. Cari Ruang Aman</div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Jauhi sementara pemicu kecemasan Anda dan temukan tempat yang tenang, teduh, atau nyaman untuk menenangkan pikiran.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
