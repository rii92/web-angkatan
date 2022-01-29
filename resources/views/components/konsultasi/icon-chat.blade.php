@props(['href', 'messageCount' => 0])

<a href="{{ $href }}" class="relative">
    <x-icons.chat stroke-width="2.0" width="22" height="22" class="text-orange-600" />

    @if ($messageCount != 0)
        <div
            class="absolute font-bold -right-2 -top-3 text-xs bg-orange-300 rounded-full w-6 h-6 flex justify-center items-center transform scale-75">
            {{ $messageCount }}
        </div>
    @endif

</a>
