<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Edit Rule</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <form method="POST" action="{{ route('admin.rules.update', $rule->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-sm font-semibold">Kategori Depresi</label>
                        <select name="depression_id" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">
                            @foreach ($depressions as $d)
                                <option value="{{ $d->id }}" @selected((string) old('depression_id', $rule->depression_id) === (string) $d->id)>
                                    {{ $d->code }} - {{ $d->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Gejala</label>
                        <select name="symptom_id" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">
                            @foreach ($symptoms as $s)
                                <option value="{{ $s->id }}" @selected((string) old('symptom_id', $rule->symptom_id) === (string) $s->id)>
                                    {{ $s->code }} - {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">CF Pakar (0 - 1)</label>
                        <input name="expert_cf" value="{{ old('expert_cf', $rule->expert_cf) }}" type="number" step="0.01" min="0" max="1" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.rules.index') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">Kembali</a>
                        <button class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
