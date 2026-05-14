<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Edit Pengguna</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <div class="mb-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Nama</div>
                    <div class="mt-1 font-semibold">{{ $user->name }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</div>
                </div>

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-sm font-semibold">Role</label>
                        <select name="role" class="mt-1 w-full rounded-lg border-gray-300 bg-white text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>admin</option>
                            <option value="user" @selected(old('role', $user->role) === 'user')>user</option>
                        </select>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">Perubahan role akan memengaruhi menu dan akses halaman.</div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">Kembali</a>
                        <button class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
