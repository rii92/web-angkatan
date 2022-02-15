<div class="my-2 mx-2">
    <div class="mb-4 flex-1 text-lg font-semibold text-gray-700 dark:text-gray-300">
        {{ $header }}
    </div>

    <div class="px-4 py-5 sm:p-6 bg-white sm:rounded-md shadow-md border border-gray-100 text-gray-800" x-data="{}"
        x-effect="const room = document.getElementById('room'); scrollParentToChild(room, room.lastElementChild)">
        <ul class="mb-6 max-h-screen overflow-y-auto overflow-x-hidden border py-2" id="room" x-effect="updateViewer">
            {{ $chats }}
        </ul>
        <hr>

        <div>{{ $footer }}</div>
    </div>

    @push('scripts')
        <script src="{{ mix('js/editor.js') }}" defer></script>
        <script src="{{ mix('js/viewer.js') }}" defer></script>
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

        <script>
            let chatEditor;
            const submitFormChat = () => Livewire.emit('submitFormChat', chatEditor ? chatEditor.getMarkdown() : '');
            const clearChatEditor = () => chatEditor.setMarkdown('');
            Livewire.on("clearChatEditor", clearChatEditor);

            const openChatEditor = () => {
                setTimeout(() => {
                    chatEditor = new Editor({
                        el: document.querySelector('#chat-editor'),
                        previewStyle: 'tab',
                        height: '250px',
                        toolbarItems: ['heading', 'bold', 'italic', 'strike', 'divider',
                            'hr',
                            'quote',
                            'divider',
                            'ul', 'ol', 'task', 'indent', 'outdent', 'divider', 'table',
                            'link',
                            'divider', 'code', 'codeblock'
                        ],
                    });
                    clearChatEditor();
                }, 500);
            }
        </script>
        <script>
            let viewer;
            window.addEventListener("DOMContentLoaded", function() {
                viewer = new Viewer(document.getElementById('room'), {
                    inline: false,
                    zoomRatio: 0.2
                });
            }, false);

            const updateViewer = () => {
                try {
                    viewer.update();
                } catch {}
            }
        </script>
    @endpush
