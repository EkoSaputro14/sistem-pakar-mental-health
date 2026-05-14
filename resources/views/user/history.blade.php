<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Riwayat Diagnosis
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold">Daftar Riwayat</div>
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">Riwayat diagnosis yang pernah Anda lakukan.</div>
                    </div>
                    <a href="{{ route('user.diagnosis') }}" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Diagnosis Baru</a>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="py-2">Tanggal</th>
                                <th class="py-2">Hasil</th>
                                <th class="py-2">Keyakinan</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse ($items as $item)
                                @php $percent = round(((float) $item->cf_value) * 100, 2); @endphp
                                <tr>
                                    <td class="py-3 whitespace-nowrap">{{ $item->created_at->format('d M Y H:i') }}</td>
                                    <td class="py-3">
                                        <div class="font-medium">{{ $item->depression?->name ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $item->depression?->code }}</div>
                                    </td>
                                    <td class="py-3">{{ number_format($percent, 2) }}%</td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('user.result', $item) }}" class="text-sky-700 hover:text-sky-900 dark:text-sky-300 dark:hover:text-sky-200 font-semibold">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada riwayat.</td>
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
