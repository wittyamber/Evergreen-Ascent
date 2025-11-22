@props(['options' => [], 'name' => '', 'selected' => ''])

<div x-data="{ open: false, selectedOption: @js($selected), options: @js($options) }" class="relative" @click.away="open = false">
    <!-- Hidden input to hold the actual form value -->
    <input type="hidden" name="{{ $name }}" x-model="selectedOption">

    <!-- The visible part of the dropdown -->
    <button type-="button" @click="open = !open" class="relative w-full cursor-default rounded-md bg-white py-2 ps-3 pe-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-ascent-blue sm:text-sm sm:leading-6">
        <span class="block truncate" x-text="selectedOption"></span>
        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pe-2">
            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.53.22l3.5 3.5a.75.75 0 01-1.06 1.06L10 4.81 6.53 8.28a.75.75 0 01-1.06-1.06l3.5-3.5A.75.75 0 0110 3z" clip-rule="evenodd" />
            </svg>
        </span>
    </button>

    <!-- The dropdown panel -->
    <ul x-show="open"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        role="listbox">
        
        <template x-for="option in options" :key="option">
            <li @click="selectedOption = option; open = false"
                class="relative cursor-default select-none py-2 ps-3 pe-9 text-gray-900 hover:bg-ascent-blue hover:text-white"
                :class="{ 'bg-ascent-blue text-white': selectedOption === option }">
                <span class="block truncate" x-text="option"></span>
                <span x-show="selectedOption === option" class="absolute inset-y-0 right-0 flex items-center pe-4">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" clip-rule="evenodd" />
                    </svg>
                </span>
            </li>
        </template>
    </ul>
</div>