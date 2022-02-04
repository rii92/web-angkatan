<div class="flex flex-wrap">
    <template x-for="blankday in blankdays">
        <div style="width: 14.28%; height: 50px"></div>
    </template>

    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
        <div style="width: 14.28%; height: 50px" class="text-center flex justify-center items-center">

            <template x-if="isActive(date['day'])">
                <div x-text="date['day']"
                    class="w-7 h-7 cursor-pointer text-center rounded-full transition ease-in-out duration-100 font-bold text-xs flex items-center justify-center border-2 border-white"
                    :class="date['color']">
                </div>
            </template>

            <template x-if="!isActive(date['day'])">
                <div x-text="date['day']"
                    class="w-7 h-7 cursor-pointer text-center rounded-full transition ease-in-out duration-100 font-bold text-xs flex items-center justify-center hover:border-white hover:border-2"
                    :class="date['color']" x-on:click="changeActiveDate(date['day'])">
                </div>
            </template>
        </div>
    </template>
</div>
