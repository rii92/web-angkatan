<x-dashboard-layout title="{{ $title }}">
    @if ($menu == 'table')
        <x-card.base title="Konsultasi List">
            @livewire('admin.konsultasi.table', ['category'=> $category])
        </x-card.base>
    @else
        @livewire('admin.konsultasi.discussion-room', ['konsul' => $konsul_id])
    @endif
</x-dashboard-layout>
