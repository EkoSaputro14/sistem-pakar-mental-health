<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Pengguna</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <form method="GET" class="grid gap-3 sm:grid-cols-3">
                    <input name="search" value="{{ request('search') }}" placeholder="Cari nama/email..." class="w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900" />

                    <select name="role" class="w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">
                        <option value="">Semua Role</option>
                        <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                        <option value="user" @selected(request('role') === 'user')>User</option>
                    </select>

                    <button class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                        Filter
                    </button>
                </form>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="py-2">Nama</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Role</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse ($items as $item)
                                <tr>
                                    <td class="py-3 font-medium">{{ $item->name }}</td>
                                    <td class="py-3">{{ $item->email }}</td>
                                    <td class="py-3">
                                        <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $item->role === 'admin' ? 'bg-sky-100 text-sky-900 dark:bg-sky-950/40 dark:text-sky-200' : 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-200' }}">
                                            {{ $item->role }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.users.edit', $item) }}" class="text-sky-700 hover:text-sky-900 dark:text-sky-300 dark:hover:text-sky-200 font-semibold">Edit</a>
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
