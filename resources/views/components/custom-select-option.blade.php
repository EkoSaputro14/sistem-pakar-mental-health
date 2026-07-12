@props(['value', 'label'])

<div
    data-value="{{ $value }}"
    data-label="{{ $label }}"
    x-on:click="
        const parent = $el.closest('[x-data]');
        if (parent._x_dataStack) {
            parent._x_dataStack[0].value = '{{ $value }}';
            parent._x_dataStack[0].label = '{{ addslashes($label) }}';
            parent._x_dataStack[0].open = false;
        }
    "
    class="flex w-full cursor-pointer items-center gap-3 px-4 py-2.5 text-sm text-slate-700 transition-colors hover:bg-teal-50 hover:text-teal-700"
>
    <span class="flex-1">{{ $label }}</span>
</div>
