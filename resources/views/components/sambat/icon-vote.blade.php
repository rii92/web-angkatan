@props(['type', 'isSelected'])

@if ($isSelected)
    <x-button.black {{ $attributes }} title="{{ ucfirst($type) }}">
        @if ($type == 'upvote')
            <x-icons.arrow-up class="w-4 h-4" />
        @elseif ($type == 'downvote')
            <x-icons.arrow-down class="w-4 h-4" />
        @endif
    </x-button.black>
@else
    <x-button.white {{ $attributes }} title="{{ ucfirst($type) }}">
        @if ($type == 'upvote')
            <x-icons.arrow-up class="w-4 h-4" />
        @elseif ($type == 'downvote')
            <x-icons.arrow-down class="w-4 h-4" />
        @endif
    </x-button.white>
@endif
