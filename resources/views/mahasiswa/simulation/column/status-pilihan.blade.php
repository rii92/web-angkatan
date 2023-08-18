<div>
    @if ($status_pilihan == AppSimulation::STATUS_PILIHAN_AMAN)
        <x-badge.success text="{{ AppSimulation::PILIHAN_AMAN }}" />
    @elseif ($status_pilihan == AppSimulation::STATUS_PILIHAN_TIDAK_AMAN)
        <x-badge.error text="{{ AppSimulation::PILIHAN_TIDAK_AMAN }}" />
    @elseif ($status_pilihan == AppSimulation::STATUS_PILIHAN_MENUNGGU)
        <x-badge.warning text="{{ AppSimulation::PILIHAN_MENUNGGU }}" />
    @endif
</div>
