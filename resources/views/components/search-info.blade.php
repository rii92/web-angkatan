<p class="mt-1 text-gray-600 text-sm">
    {{ $message }}

    @if (isset($tag))
        <x-badge.success text="{{ $tag }}" class="mr-0" />
    @else
        <b>"{{ $keyword }}"</b>
    @endif

    <span class="underline text-blue-600 cursor-pointer" wire:click="$emitSelf('selectTag')">Clear</span>
</p>
