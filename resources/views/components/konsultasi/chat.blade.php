@props(['description', 'isLeft', 'isRead', 'createdAt', 'canDelete' => false, 'chatId', 'route', 'chatType' => AppKonsul::TYPE_CHAT_TEXT])

<li class="flex mb-3 {{ $isLeft ? 'ml-3' : 'mr-3 justify-end' }}">
    @if ($chatType == AppKonsul::TYPE_CHAT_IMAGE)
        <div class="max-w-sm w-auto {{ $isLeft ? 'mr-4' : 'ml-4' }}">
            <div
                class="max-h-48 cursor-pointer hover:opacity-60 transition overflow-hidden border-2 {{ $isLeft ? 'border-light-4' : 'border-subtle' }}">
                <img src="{{ asset('storage/' . $description) }}"
                    alt="{{ str_replace('konsultasi/', '', $description) }}">
            </div>
            <p class="text-xs italic mt-1 w-full flex {{ $canDelete ? 'justify-between' : 'justify-end' }}">
                @if (!$isLeft && $canDelete)
                    <small class="text-red-700 font-bold cursor-pointer mr-4"
                        onclick="Livewire.emit('openModal', 'konsultasi.modal-delete-chat', {{ json_encode(['chat_id' => $chatId, 'route' => $route, 'chatType' => $chatType]) }})">Delete</small>
                @endif
                <small class="text-gray-400">{{ $createdAt }} WIB. {{ $isRead ? 'Read' : '' }}</small>

            </p>
        </div>
    @else
        <div
            class="px-4 py-3 rounded-b-lg w-auto max-w-3xl relative {{ $isLeft ? 'bg-light-4 rounded-tr-lg mr-4' : 'bg-subtle rounded-tl-lg ml-4' }}">
            <div class="prose chat max-w-none {{ $isLeft ? 'chat-left' : 'chat-right' }}">
                {!! Str::markdown($description) !!}
            </div>

            <p class="text-xs italic mt-1 w-full flex {{ $canDelete ? 'justify-between' : 'justify-end' }}">
                @if (!$isLeft && $canDelete)
                    <small class="text-red-700 font-bold cursor-pointer mr-4"
                        onclick="Livewire.emit('openModal', 'konsultasi.modal-delete-chat', {{ json_encode(['chat_id' => $chatId, 'route' => $route, 'chatType' => $chatType]) }})">Delete</small>
                @endif
                <small>{{ $createdAt }} WIB. {{ $isRead ? 'Read' : '' }}</small>

            </p>

            <div class="w-4 overflow-hidden inline-block absolute  top-4 {{ $isLeft ? '-left-3' : '-right-4' }}">
                <div
                    class="h-8  transform  {{ $isLeft ? 'origin-top-right bg-light-4 -rotate-45' : 'origin-top-left bg-subtle rotate-45' }}">
                </div>
            </div>
        </div>
    @endif
</li>
