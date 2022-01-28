@props(['description', 'isLeft', 'isRead', 'createdAt', 'canDelete' => false, 'chatId', 'route'])

<li class="flex mb-3 {{ $isLeft ? 'ml-3' : 'mr-3 justify-end' }}">
    <div
        class="p-4 rounded-b-lg w-auto max-w-3xl relative {{ $isLeft ? 'bg-light-4 rounded-tr-lg mr-4' : 'bg-subtle rounded-tl-lg ml-4' }}">
        <div class="prose chat max-w-none {{ $isLeft ? 'chat-left' : 'chat-right' }}">
            {!! Str::markdown($description) !!}
        </div>

        <p class="text-xs italic mt-1 w-full flex {{ $canDelete ? 'justify-between' : 'justify-end' }}">
            @if (!$isLeft && $canDelete)
                <span class="text-red-700 font-bold cursor-pointer mr-4"
                    onclick="Livewire.emit('openModal', 'konsultasi.modal-delete-chat', {{ json_encode(['chat_id' => $chatId, 'route' => $route]) }})">Delete</span>
            @endif
            <span>{{ $createdAt }} WIB. {{ $isRead ? 'Read' : '' }}</span>

        </p>

        <div class="w-4 overflow-hidden inline-block absolute  top-4 {{ $isLeft ? '-left-3' : '-right-4' }}">
            <div
                class="h-8  transform  {{ $isLeft ? 'origin-top-right bg-light-4 -rotate-45' : 'origin-top-left bg-subtle rotate-45' }}">
            </div>
        </div>
    </div>
</li>
