<div>
    @if ($start > now())
        <x-badge.warning text="{{ AppSimulation::BELUM_MEMILIH }}" />
    @elseif ($start <= now() && $end >= now())
        @if ($pilihan_pertama)
            <x-badge.success text="{{ AppSimulation::SUDAH_MEMILIH }}" />
        @else
            <x-badge.primary text="{{ AppSimulation::SEDANG_MEMILIH }}" />
        @endif
    @else
        @if ($pilihan_pertama)
            <x-badge.success text="{{ AppSimulation::SUDAH_MEMILIH }}" />
        @else
            <x-badge.error text="{{ AppSimulation::TIDAK_MEMILIH }}" />
        @endif
    @endif
</div>
