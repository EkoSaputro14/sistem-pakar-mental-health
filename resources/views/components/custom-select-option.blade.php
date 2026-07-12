@props(['value', 'label', 'selected' => false])

<button
    type="button"
    data-value="{{ $value }}"
    x-on:click="$dispatch('select', { value: '{{ $value }}', label: '{{ $label }}' }); $el.closest('[x-data]').__x.$data.select('{{ $value }}', '{{ $label }}')"
    class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-slate-700 transition-colors hover:bg-teal-50 hover:text-teal-700"
    :class="{ 'bg-teal-50 text-teal-700 font-semibold': $el.closest('[x-data]').__x.$data.value === '{{ $value }}' }"
>
    <span class="flex-1">{{ $label }}</span>
    <svg x-show="$el.closest('[x-data]').__x.$data.value === '{{ $value }}'" class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
</button>
