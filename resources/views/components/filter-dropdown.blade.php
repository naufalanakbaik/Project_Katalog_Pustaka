@props(['name', 'label', 'options' => [], 'selectedLabel' => null, 'valueKey' => 'id', 'labelKey' => 'name'])

<div x-data="{ open: false, selected: '{{ $selectedLabel ?? $label }}'}" 
    class="relative w-full md:w-64">

    <button type="button" @click="open = !open"
        class="w-full flex justify-between items-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">

        <span x-text="selected"></span>

        <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
            stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" x-cloak @click.away="open = false" x-transition
        class="absolute z-10 mt-1 w-full rounded-md border bg-white shadow-lg">

        <ul class="max-h-60 overflow-auto py-1">

            {{-- Default --}}
            <li @click="selected='{{ $label }}'; open=false; $refs.hidden.value=''"
                class="cursor-pointer px-4 py-2 text-gray-700 hover:bg-gray-100"
                :class="{ 'bg-blue-200 font-semibold': selected === '{{ $label }}' }">
                {{ $label }}
            </li>

            {{-- Options --}}
            @foreach ($options as $option)
                <li @click="selected='{{ $option->$labelKey }}'; open=false; $refs.hidden.value='{{ $option->$valueKey }}'"
                    class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                    :class="{ 'bg-blue-200 font-semibold': selected === '{{ $option->$labelKey }}' }">
                    {{ $option->$labelKey }}
                </li>
            @endforeach

        </ul>
    </div>

    <input type="hidden" name="{{ $name }}" x-ref="hidden" value="{{ request($name) }}">
</div>
