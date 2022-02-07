@props(['photo', 'name', 'text', 'time', 'type'])

<li class="mb-8 sm:-ml-7 -ml-6 relative">
    <span
        class="sm:flex hidden absolute -left-14 top-3 justify-center items-center w-10 h-10 rounded-full dark:ring-gray-900 dark:bg-blue-900">
        <img class="rounded-full shadow-lg" src="{{ $photo }}" alt="{{ $name }}"
            title="{{ $name }}" />
    </span>
    <div
        class="sm:py-4 sm:px-6 p-3 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-700 dark:border-gray-600 relative">

        @if ($type == AppKonsul::TYPE_CHAT_TEXT)
            <div class="prose chat chat-guest  max-w-none">
                {!! Str::markdown($text) !!}
            </div>
        @else
            <div class="max-h-52 max-w-md cursor-pointer hover:opacity-60 transition overflow-hidden border-2">
                <img class="image-chat" src="{{ Storage::disk('public')->url($text) }}"
                    alt="{{ Storage::disk('public')->url($text) }}">
            </div>
        @endif

        <div class="text-xs font-normal text-gray-400 italic flex justify-between mt-2 items-center">
            <div class="flex items-center">
                <img class="rounded-full sm:hidden h-7 w-7 mr-2" src="{{ $photo }}" alt="{{ $name }}"
                    title="{{ $name }}" />
                <span>{{ $name }}</span>
            </div>

            <time>
                @if ($time->gte(now()->subDays(2)))
                    {{ $time->diffForHumans() }}
                @else
                    {{ $time->format('d-M H:i') }} WIB
                @endif
            </time>
        </div>

        <div class="w-4 overflow-hidden sm:inline-block hidden absolute  top-4 -left-4">
            <div class="h-8  transform origin-top-right bg-white -rotate-45 border">
            </div>
        </div>

    </div>
</li>
