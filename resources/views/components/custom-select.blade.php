@props(['name', 'id' => null, 'selected' => null, 'placeholder' => 'Pilih...', 'required' => false])

<div
    x-data="{
        open: false,
        value: @js($selected ?? ''),
        label: '',
        init() {
            this.$nextTick(() => {
                const el = this.$el.querySelector('[data-value=\"' + this.value + '\"]');
                if (el) this.label = el.dataset.label;
            });
        }
    }"
    x-on:click.outside="open = false"
    class="relative"
>
    <input type="hidden" name="{{ $name }}" :value="value" @if($required) required @endif />

    <button
        type="button"
        x-on:click="open = !open"
        class="flex w-full items-center justify-between rounded-xl border border-slate-200 bg-white/80 px-4 py-2.5 text-sm text-left shadow-sm transition-all duration-200 hover:border-slate-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none"
        :class="{ 'border-teal-500 ring-2 ring-teal-500/20': open }"
    >
        <span x-text="label || '{{ $placeholder }}'" :class="label ? 'text-slate-900 font-medium' : 'text-slate-400'"></span>
        <svg class="h-4 w-4 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute z-50 mt-1.5 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50"
        style="display: none;"
    >
        <div class="max-h-60 overflow-y-auto py-1">
            {{ $slot }}
        </div>
    </div>
</div>
