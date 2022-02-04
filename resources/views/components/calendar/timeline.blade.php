<div class="flex justify-center max-w-4xl m-auto">
    <div x-data="setCalendar(@this.events)" x-cloak>
        <div class="md:flex">
            <div class="flex justify-center">
                <div class="bg-green-400 max-w-96 rounded-lg">
                    <div class="bg-main rounded-lg shadow overflow-hidden text-white p-2">
                        @include('components.calendar.header')
                        @include('components.calendar.body')
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto px-5 md:max-w-96">
                @include('components.calendar.detail')
            </div>
        </div>
    </div>
    <script src="{{ mix('js/calendar.js') }}"></script>
</div>