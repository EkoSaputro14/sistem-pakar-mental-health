@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full bg-teal-50 px-3 py-2 text-sm font-semibold leading-5 text-teal-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 dark:bg-teal-400/10 dark:text-teal-200'
            : 'inline-flex items-center rounded-full px-3 py-2 text-sm font-semibold leading-5 text-slate-500 transition duration-150 ease-in-out hover:bg-white/70 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
