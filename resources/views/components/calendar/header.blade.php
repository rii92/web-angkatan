<div class="flex items-center justify-between py-6 px-6">
    <button type="button"
        class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
        x-on:click="month--; changeMonth()">
        <x-icons.arrow-left class="text-gray-500" />
    </button>

    <div class="text-white font-medium text-lg">
        <span x-text="MONTH_NAMES[month]"></span>
        <span x-text="year" class="ml-1"></span>
    </div>

    <button type="button"
        class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
        x-on:click="month++; changeMonth()">
        <x-icons.arrow-right class="text-gray-500" />
    </button>
</div>

<div class="flex flex-wrap ">
    <template x-for="(day, index) in DAYS" :key="index">
        <div style="width: 14.26%" class="px-2 py-2">
            <div x-text="day.slice(0,3)"
                class="text-white text-xs font-light uppercase tracking-wide text-center opacity-50">
            </div>
        </div>
    </template>
</div>
