@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full border-l-4 border-teal-500 bg-teal-50 py-2 pe-4 ps-3 text-start text-base font-semibold text-teal-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 dark:bg-teal-400/10 dark:text-teal-200'
            : 'block w-full border-l-4 border-transparent py-2 pe-4 ps-3 text-start text-base font-semibold text-slate-600 transition duration-150 ease-in-out hover:border-teal-200 hover:bg-white/70 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
