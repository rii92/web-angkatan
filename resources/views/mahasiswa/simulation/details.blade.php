<x-dashboard-layout title="{{ $simulation->title }}">
  <x-card.base title="Daftar Satker">
      @livewire('mahasiswa.simulation.satker-table')
  </x-card.base>
</x-dashboard-layout>
