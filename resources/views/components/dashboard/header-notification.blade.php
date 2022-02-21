<x-jet-dropdown align="right" width="96">
    <x-slot name="trigger">
        <div x-data="{showUnreadNotifications : true}">
            <button
                class="relative flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition p-1"
                x-on:click="showUnreadNotifications = false; setTimeout(() => {Livewire.emit('readNotifications');}, 2000);">
                <x-icons.bell stroke-width="1" width="24" height="24"></x-icons.bell>
                @if ($totalUnreadNotifications)
                    <div x-show="showUnreadNotifications"
                        class="absolute font-bold -right-1 -top-2 text-xs bg-orange-300 rounded-full w-6 h-6 flex justify-center items-center transform scale-75">
                        {{ $totalUnreadNotifications }}
                    </div>
                @endif
            </button>
        </div>
    </x-slot>

    <x-slot name="content">
        <ul class="divide-y max-h-96 sm:w-96 w-full max-w-full overflow-y-auto pb-2" id="notif-container">
            @forelse ($notif as $n)
                <x-jet-dropdown-link href="{{ $n->data['link'] }}"
                    class="{{ $n->read_at ? __('bg-white') : __('bg-gray-100') }} ">
                    <p class="text-xs">{!! $n->data['message'] !!}</p>
                    <p class="italic text-right text-xs text-gray-500 my-1">
                        {{ $n->created_at->format('d M Y H:i') }} WIB
                    </p>
                </x-jet-dropdown-link>
            @empty
                <li class="p-2 text-sm text-gray-500">
                    <p class="text-center italic">Belum ada notifikasi</p>
                </li>
            @endforelse
        </ul>
    </x-slot>

    @push('scripts')
        <script>
            // lazy load when scroll
            const notifContainer = document.getElementById("notif-container");
            notifContainer.addEventListener("scroll", function() {
                const offset = 100;
                if (this.scrollHeight - this.scrollTop < this.clientHeight + offset) {
                    if (@this.totalDisplay < @this.totalNotifications)
                        @this.totalDisplay += 5
                }
            }, {
                passive: false
            });
        </script>
    @endpush
</x-jet-dropdown>
