<{{ $tag }} class="text-center">
    @if ($terpilih)
        <x-badge.success text="Terpilih" />
    @else
        <x-badge.error text="Tidak Terpilih" />
    @endif
    </ {{ $tag }}>
