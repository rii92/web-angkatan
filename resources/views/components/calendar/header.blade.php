<div class="flex items-center justify-between px-6 py-6">
    <button type="button"
        class="inline-flex items-center p-1 leading-none transition duration-100 ease-in-out rounded-lg cursor-pointer hover:bg-gray-200"
        x-on:click="month--; changeMonth()">
        <x-icons.arrow-left class="text-gray-500" />
    </button>

    <div class="text-lg font-medium text-white">
        <span x-text="MONTH_NAMES[month]"></span>
        <span x-text="year" class="ml-1"></span>
    </div>

    <button type="button"
        class="inline-flex items-center p-1 leading-none transition duration-100 ease-in-out rounded-lg cursor-pointer hover:bg-gray-200"
        x-on:click="month++; changeMonth()">
        <x-icons.arrow-right class="text-gray-500" />
    </button>
</div>

<div class="flex flex-wrap ">
    <template x-for="(day, index) in DAYS" :key="index">
        <div style="width: 14.26%" class="px-2 py-2">
            <div x-text="day.slice(0,3)"
                class="text-xs font-light tracking-wide text-center text-white uppercase opacity-50">
            </div>
        </div>
    </template>
</div>
