<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Manajemen Data</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                    Tambah Gejala Baru
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/20 sm:p-8">
                <form method="POST" action="{{ route('admin.symptoms.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Kode Gejala</label>
                        <input name="code" value="{{ old('code') }}" placeholder="A001" class="mt-2 block w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" required />
                        @error('code')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Nama Gejala / Identifier Internal</label>
                        <input name="name" value="{{ old('name') }}" placeholder="Contoh: Kesedihan mendalam" class="mt-2 block w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" required />
                        @error('name')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Pertanyaan untuk Pengguna</label>
                        <textarea name="question" rows="3" placeholder="Apakah Anda merasa sedih secara tiba-tiba?" class="mt-2 block w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" required>{{ old('question') }}</textarea>
                        @error('question')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Nilai CF Pakar (0.0 - 1.0)</label>
                        <input name="base_cf" value="{{ old('base_cf', '0.0') }}" type="number" step="0.01" min="0" max="1" class="mt-2 block w-full rounded-xl border-slate-200 bg-white/70 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900/50" required />
                        @error('base_cf')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <input id="is_active" name="is_active" value="1" type="checkbox" checked class="h-4.5 w-4.5 rounded border-slate-300 text-teal-600 focus:ring-teal-500 dark:border-white/10 dark:bg-slate-900" />
                        <label for="is_active" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Aktifkan Gejala (tampilkan di skrining)</label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 dark:border-white/5">
                        <a href="{{ route('admin.symptoms.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10">
                            <i data-lucide="x" class="h-4 w-4"></i>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-600/20 transition hover:-translate-y-0.5 hover:bg-teal-700">
                            <i data-lucide="save" class="h-4 w-4"></i>
                            Simpan Gejala
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
