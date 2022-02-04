@props(['route', 'chat'])

@php
// if user is not admin, admin is admin who can open discussion room from admin menu
$canDelete = $route == 'admin' ? $chat->is_admin : !$chat->is_admin;

$isRead = $route == 'admin' ? $chat->is_seen && $chat->is_admin : $chat->is_seen && !$chat->is_admin;

// chat from admin is always left if you, regular user, open discussion room, otherwise
$isLeft = $route == 'admin' ? !$chat->is_admin : $chat->is_admin;
@endphp

<li class="flex mb-3 {{ $isLeft ? 'ml-3' : 'mr-3 justify-end' }}">
    @if ($chat->type == AppKonsul::TYPE_CHAT_IMAGE)
        <div class="max-w-sm w-auto {{ $isLeft ? 'mr-4' : 'ml-4' }}">
            <div
                class="max-h-48 cursor-pointer hover:opacity-60 transition overflow-hidden border-2 {{ $isLeft ? 'border-light-4' : 'border-subtle' }}">
                <img src="{{ Storage::disk('public')->url($chat->chat) }}"
                    alt="{{ Storage::disk('public')->url($chat->chat) }}">
            </div>
            <p class="text-xs italic mt-1 w-full flex {{ $canDelete ? 'justify-between' : 'justify-end' }}">
                @if (!$isLeft && $canDelete)
                    <small class="text-red-700 font-bold cursor-pointer mr-4"
                        onclick="Livewire.emit('openModal', 'konsultasi.modal-delete-chat', {{ json_encode(['chat_id' => $chat->id, 'route' => $route, 'chatType' => $chat->type]) }})">
                        Delete
                    </small>
                @endif
                <div class="text-xs text-gray-400">
                    {{ $chat->created_at->format('d M H:i') }} WIB. {{ $isRead ? 'Read' : '' }}
                </div>
            </p>
        </div>
    @else
        <div
            class="px-4 py-3 rounded-lg w-auto max-w-3xl relative  border {{ $isLeft ? 'bg-light-4 mr-4' : 'bg-blue-50 ml-4' }}">
            <div class="prose chat max-w-none {{ $isLeft ? 'chat-left' : 'chat-right' }}">
                {!! Str::markdown($chat->chat) !!}
            </div>

            <p class="text-xs mt-4 w-full flex {{ $canDelete ? 'justify-between' : 'justify-end' }}">
                @if (!$isLeft && $canDelete)
                    <small class="text-red-700 font-bold cursor-pointer mr-4"
                        onclick="Livewire.emit('openModal', 'konsultasi.modal-delete-chat', {{ json_encode(['chat_id' => $chat->id, 'route' => $route, 'chatType' => $chat->type]) }})">
                        DELETE
                    </small>
                @endif
                <small class="text-xs">
                    {{ $chat->created_at->format('d M H:i') }} WIB. {{ $isRead ? 'Read' : '' }}
                </small>
            </p>

            <div class="w-4 overflow-hidden inline-block absolute  top-4 {{ $isLeft ? '-left-3' : '-right-4' }}">
                <div
                    class="h-8  transform  {{ $isLeft ? 'origin-top-right bg-light-4 -rotate-45' : 'origin-top-left bg-blue-100 rotate-45' }}">
                </div>
            </div>
        </div>
    @endif
</li>
