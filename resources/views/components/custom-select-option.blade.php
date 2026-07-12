@props(['value', 'label'])

<button
    type="button"
    data-value="{{ $value }}"
    data-label="{{ $label }}"
    x-on:click="
        let el = $el.parentElement.closest('[x-data]');
        if (el && el._x_dataStack && el._x_dataStack[0]) {
            el._x_dataStack[0].select('{{ $value }}', '{{ addslashes($label) }}');
        }
    "
    class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-slate-700 transition-colors hover:bg-teal-50 hover:text-teal-700"
>
    <span class="flex-1">{{ $label }}</span>
    <svg class="h-4 w-4 text-teal-600 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
</button>
