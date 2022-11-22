<x-dashboard-layout title="{{ $simulation->title }}">
    <div class="flex flex-col md:flex-row mb-4">
        <x-card.base class="flex-1">
            <div>
                <h3 class="font-bold">Todo: Mekanisme Simulasi Penempatan</h3>
                <ul style="list-style-type: ">
                    <li>Simulasi dilakukan bla...bla...bla...bla...</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold">Todo: Harap Perhatian</h3>
                <ul style="list-style-type: ">
                    <li>Todo: Pesan-pesan sebelum memilih penempatan</li>
                </ul>
            </div>
        </x-card.base>
        @livewire('mahasiswa.simulation.selection', ['simulation' => $simulation])
    </div>
    <x-card.base title="Daftar Satker">
        @livewire('mahasiswa.simulation.satker-table', ['simulation_id' => $simulation->id])
    </x-card.base>
    <x-card.base title="Peserta Simulasi">
        @livewire('mahasiswa.simulation.users-table', ['simulation_id' => $simulation->id])
    </x-card.base>
</x-dashboard-layout>
