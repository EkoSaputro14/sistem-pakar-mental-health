@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 text-teal-600 transition duration-150 ease-in-out focus:outline-none dark:text-teal-400 relative'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-slate-500 transition duration-150 ease-in-out hover:text-slate-900 focus:outline-none dark:text-slate-400 dark:hover:text-white relative';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
