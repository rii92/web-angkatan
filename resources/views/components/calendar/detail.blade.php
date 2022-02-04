<div class="pt-5 md:pt-0 md:pl-5">
    <h2 class="font-bold text-gray-700 md:text-2xl text-xl md:text-left mb-3 md:whitespace-nowrap" x-text="formatDate()">
    </h2>

    <div class="text-sm text-gray-700">
        <template x-if="eventToDisplay.length != 0">
            <template x-for="(event, index) in eventToDisplay" :key="index">
                <div class="mb-3">
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-sm" :class="event['color']"></span>
                        <h3 class="ml-2 text-md font-bold text-gray-700" x-text="event['title']"></h3>
                    </div>
                    <p class="ml-5 leading-tight" x-text="event['description']"></p>
                </div>
            </template>
        </template>

        <template x-if="eventToDisplay.length == 0">
            <p class="md:text-left text-center leading-tight italic">
                Tidak terdapat kegiatan apapun. Have a nice day! Jangan lupa skripsi!!
            </p>
        </template>
    </div>
</div>
