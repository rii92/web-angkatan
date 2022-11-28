<form wire:submit.prevent="handleForm">
    <x-modal.header title="Pilihan {{ $user->user->name }}" bordered />
    <x-modal.body>
        <x-description-list title="Kelas" class="bg-gray-50">
            {{ $user->user->details->kelas }}
        </x-description-list>

        <x-description-list title="Asal">
            {{ $user->user->details->location->kabupaten ?? 'Belum diisi' }}
        </x-description-list>

        <x-description-list title="Status Pemilihan" class="bg-gray-50">
            {{ view('mahasiswa.simulation.column.status-pemilihan', [
                'start' => $user->session_time->start_time,
                'end' => $user->session_time->end_time,
                'pilihan_pertama' => $user->satker_1,
            ]) }}
        </x-description-list>

        @if ($user->satker1)
            <x-description-list title="Pilihan Pertama">
                {{ $user->satker1->kode_wilayah }} - {{ $user->satker1->name }} -
                {{ $user->satker1->location->provinsi }}

                @if ($user->satker_1 == $user->satker_final)
                    {{ view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => true, 'tag' => 'span']) }}
                @endif

            </x-description-list>
        @endif

        @if ($user->satker2)
            <x-description-list title="Pilihan Kedua" class="bg-gray-50">
                {{ $user->satker2->kode_wilayah }} - {{ $user->satker2->name }} -
                {{ $user->satker2->location->provinsi }}

                @if ($user->satker_2 == $user->satker_final)
                    {{ view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => true, 'tag' => 'span']) }}
                @endif
            </x-description-list>
        @endif

        @if ($user->satker3)
            <x-description-list title="Pilihan Ketiga">
                {{ $user->satker3->kode_wilayah }} - {{ $user->satker3->name }} -
                {{ $user->satker3->location->provinsi }}

                @if ($user->satker_3 == $user->satker_final)
                    {{ view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => true, 'tag' => 'span']) }}
                @endif
            </x-description-list>
        @endif

        @if ($user->satker_final)
            <x-description-list title="Pilihan Final" class="bg-gray-50">
                {{ $user->satker_final->kode_wilayah }} - {{ $user->satker_final->name }} -
                {{ $user->satker_final->location->provinsi }}
            </x-description-list>
        @endif

        @if ($user->satker_final)
            <x-description-list title="Updated At">
                {{ $user->satker_final_updated_at->format('l, d-F-Y H:i:s') }}
            </x-description-list>
        @endif

    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
