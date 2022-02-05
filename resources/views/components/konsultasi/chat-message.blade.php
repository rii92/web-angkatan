@props(['message', 'isLeft', 'time', 'isRead' => false])

<li class="flex mb-3 {{ $isLeft ? 'ml-3' : 'mr-3 justify-end' }}">
    <div
        class="px-4 py-3 rounded-lg w-auto max-w-3xl relative  border {{ $isLeft ? 'bg-light-4 mr-4' : 'bg-blue-50 ml-4' }}">
        <div class="prose chat max-w-none {{ $isLeft ? 'chat-left' : 'chat-right' }}">
            {!! Str::markdown($message) !!}
        </div>

        <p class="text-xs mt-4 w-full flex justify-end italic">
            <small class="text-xs">
                {{ $time->format('d M H:i') }} WIB. {{ $isRead ? 'Read' : '' }}
            </small>
        </p>

        <div class="w-4 overflow-hidden inline-block absolute  top-4 {{ $isLeft ? '-left-3' : '-right-4' }}">
            <div
                class="h-8  transform  {{ $isLeft ? 'origin-top-right bg-light-4 -rotate-45' : 'origin-top-left bg-blue-100 rotate-45' }}">
            </div>
        </div>
    </div>
</li>
