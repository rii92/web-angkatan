<div class="flex justify-center max-w-4xl m-auto">
    <div x-data="setCalendar(@this.events)" x-cloak>
        <div class="md:flex">
            <div class="flex justify-center">
                <div class="bg-green-400 rounded-lg max-w-96">
                    <div class="p-2 overflow-hidden text-white rounded-lg shadow bg-blue-sidebar">
                        @include('components.calendar.header')
                        @include('components.calendar.body')
                    </div>
                </div>
            </div>
            <div class="w-full px-5 mx-auto md:max-w-96">
                @include('components.calendar.detail')
            </div>
        </div>
    </div>
    <script src="{{ mix('js/calendar.js') }}"></script>
</div>