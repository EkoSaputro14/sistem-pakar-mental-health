<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Tentang Depresi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <h3 class="text-lg font-semibold">Apa itu depresi?</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Depresi adalah kondisi kesehatan mental yang ditandai dengan suasana hati sedih berkepanjangan dan/atau kehilangan minat, yang dapat disertai perubahan tidur, nafsu makan, energi, konsentrasi, dan fungsi sosial.
                </p>

                <h3 class="mt-6 text-lg font-semibold">Kapan perlu mencari bantuan?</h3>
                <ul class="mt-2 list-disc pl-5 text-sm text-gray-600 dark:text-gray-300 space-y-1">
                    <li>Gejala berlangsung lebih dari 2 minggu dan mengganggu aktivitas.</li>
                    <li>Kesulitan belajar/berinteraksi secara signifikan.</li>
                    <li>Muncul pikiran menyakiti diri atau merasa tidak aman.</li>
                </ul>

                <h3 class="mt-6 text-lg font-semibold">Tentang Sistem Pakar ini</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Sistem menggunakan metode <span class="font-medium">Certainty Factor</span> untuk menghitung tingkat keyakinan berdasarkan kombinasi nilai CF pakar dan jawaban pengguna.
                </p>

                <div class="mt-6">
                    <a href="{{ route('user.diagnosis') }}" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                        Mulai Diagnosis
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
