<x-dashboard-layout title="{{ $simulation->title }}">
    <x-card.base title="{{ $satker->full_name }}">
        @livewire('mahasiswa.simulation.satker-detail-table', ['simulation_id' => $simulation->id, 'satker_id' => $satker->id])

        <div class="flex justify-end">
            <x-anchor.secondary href="{{ route('user.simulasi.details', ['simulation' => $simulation->id]) }}"
                class="ml-2">
                Back
            </x-anchor.secondary>
        </div>
    </x-card.base>
</x-dashboard-layout>
