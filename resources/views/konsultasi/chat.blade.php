<div class="relative w-full p-3 overflow-y-auto h-[40rem]">
    <ul class="space-y-2">
        @foreach ($chats->get() as $chat)
            <x-chat position="{{ auth()->user()->id == $chat->user_id ? 'start' : 'end' }}">
                <div>
                    <b>{{ $chat->user->name }} - </b>
                    <small>{{ $chat->created_at->diffForHumans() }}</small>
                </div>
                {!! $chat->chat !!}
            </x-chat>
        @endforeach
    </ul>
</div>
