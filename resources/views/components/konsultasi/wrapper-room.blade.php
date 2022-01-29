<div class="my-2 mx-2">
    <div class="mb-4 flex-1 text-lg font-semibold text-gray-700 dark:text-gray-300">
        {{ $header }}
    </div>

    <div class="px-4 py-5 sm:p-6 bg-white sm:rounded-md shadow-md border border-gray-100 text-gray-800" x-data="{}"
        x-effect="const room = document.getElementById('room'); scrollParentToChild(room, room.lastElementChild)">
        <ul class="mb-6 max-h-screen overflow-y-auto overflow-x-hidden border py-2" id="room">
            {{ $chats }}
        </ul>
        <hr>

        <div>{{ $footer }}</div>
    </div>

    @push('scripts')
        <script src="{{ mix('js/editor.js') }}" defer></script>
        <script>
            const scrollParentToChild = (parent, child) => {
                // Where is the parent on page
                const parentRect = parent.getBoundingClientRect();
                // What can you see?
                const parentViewableArea = {
                    height: parent.clientHeight,
                    width: parent.clientWidth
                };

                // Where is the child
                const childRect = child.getBoundingClientRect();
                // Is the child viewable?
                const isViewable = (childRect.top >= parentRect.top) && (childRect.bottom <= parentRect.top +
                    parentViewableArea
                    .height);

                // if you can't see the child try to scroll parent
                if (!isViewable) {
                    // Should we scroll using top or bottom? Find the smaller ABS adjustment
                    const scrollTop = childRect.top - parentRect.top;
                    const scrollBot = childRect.bottom - parentRect.bottom;
                    if (Math.abs(scrollTop) < Math.abs(scrollBot)) {
                        // we're near the top of the list
                        parent.scrollTop += scrollTop;
                    } else {
                        // we're near the bottom of the list
                        parent.scrollTop += scrollBot;
                    }
                }

            }
        </script>
    @endpush
</div>
