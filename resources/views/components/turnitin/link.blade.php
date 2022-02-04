<p class="text-center">
    @if ($link)
        <x-link target="_blank" href="{{ $link }}">Link Drive</x-link>
    @else
        <span class="italic text-xs text-gray-400">Belum Tersedia</span>
    @endif
</p>
