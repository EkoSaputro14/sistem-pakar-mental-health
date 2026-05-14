<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Tambah Rekomendasi</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <form method="POST" action="{{ route('admin.recommendations.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="text-sm font-semibold">Kategori Depresi</label>
                        <select name="depression_id" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">
                            @foreach ($depressions as $d)
                                <option value="{{ $d->id }}" @selected((string) old('depression_id') === (string) $d->id)>
                                    {{ $d->code }} - {{ $d->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Judul</label>
                        <input name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Isi Rekomendasi</label>
                        <textarea name="content" rows="6" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">{{ old('content') }}</textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="is_active" name="is_active" value="1" type="checkbox" checked class="rounded border-gray-300 text-sky-600 focus:ring-sky-500 dark:border-gray-700" />
                        <label for="is_active" class="text-sm">Aktif</label>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.recommendations.index') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">Batal</a>
                        <button class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
