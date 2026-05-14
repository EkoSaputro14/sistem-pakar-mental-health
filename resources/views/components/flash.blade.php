@props([])

@php
    $success = session('success');
    $error = session('error');
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if ($success)
        <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-100">
            <div class="text-sm font-medium">Berhasil</div>
            <div class="text-sm mt-1">{{ $success }}</div>
        </div>
    @endif

    @if ($error)
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900 dark:border-rose-900/40 dark:bg-rose-950/40 dark:text-rose-100">
            <div class="text-sm font-medium">Gagal</div>
            <div class="text-sm mt-1">{{ $error }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-amber-900 dark:border-amber-900/40 dark:bg-amber-950/40 dark:text-amber-100">
            <div class="text-sm font-medium">Periksa kembali</div>
            <ul class="mt-2 list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
