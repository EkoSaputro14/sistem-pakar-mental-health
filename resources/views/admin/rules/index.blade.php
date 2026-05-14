<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Rule Diagnosis</h2>
            <a href="{{ route('admin.rules.create') }}" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Tambah</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <input name="search" value="{{ request('search') }}" placeholder="Cari kategori/gejala..." class="w-full sm:w-96 rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900" />
                    <button class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">Cari</button>
                </form>

                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">CF pakar di sini dipakai sebagai nilai <span class="font-semibold">CFpakar</span> pada rumus CF(H,E).</div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="py-2">Kategori</th>
                                <th class="py-2">Gejala</th>
                                <th class="py-2">CF Pakar</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse ($items as $item)
                                <tr>
                                    <td class="py-3">
                                        <div class="text-xs font-semibold text-sky-700 dark:text-sky-300">{{ $item->depression?->code }}</div>
                                        <div class="font-medium">{{ $item->depression?->name }}</div>
                                    </td>
                                    <td class="py-3">
                                        <div class="text-xs font-semibold text-sky-700 dark:text-sky-300">{{ $item->symptom?->code }}</div>
                                        <div class="font-medium">{{ $item->symptom?->name }}</div>
                                    </td>
                                    <td class="py-3">{{ number_format((float) $item->expert_cf, 2) }}</td>
                                    <td class="py-3 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.rules.edit', $item->id) }}" class="text-sky-700 hover:text-sky-900 dark:text-sky-300 dark:hover:text-sky-200 font-semibold">Edit</a>
                                        <form class="inline" method="POST" action="{{ route('admin.rules.destroy', $item->id) }}" onsubmit="return confirm('Hapus rule ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="ml-3 text-rose-700 hover:text-rose-900 dark:text-rose-300 dark:hover:text-rose-200 font-semibold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500 dark:text-gray-400">Data kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
