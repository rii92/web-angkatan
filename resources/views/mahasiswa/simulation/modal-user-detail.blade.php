<form wire:submit.prevent="handleForm">
    <x-modal.header title="Pilihan {{ $user->user->name }} ({{ $user->user->details->nim }})" bordered />
    <x-modal.body>
        <x-description-list title="Kelas" class="bg-gray-50">
            {{ $user->user->details->kelas }} - {{ strtoupper($user->based_on) }} - Ranking {{ $user->user_rank }}
        </x-description-list>

        <x-description-list title="Asal">
            {{ $user->user->details->location->kabupaten ?? 'Belum diisi' }}
        </x-description-list>

        <x-description-list title="Status Pemilihan dan Pilihan" class="bg-gray-50">
            <div class="flex">
                {{ view('mahasiswa.simulation.column.status-pemilihan', [
                    'start' => $user->session_time->start_time,
                    'end' => $user->session_time->end_time,
                    'pilihan_pertama' => $user->satker_1,
                ]) }}

                {{ view('mahasiswa.simulation.column.status-pilihan', ['status_pilihan' => $user->status_pilihan]) }}
            </div>
        </x-description-list>

        @if ($user->satker1)
            <x-description-list title="Pilihan Pertama">
                <x-link target="_blank"
                    href="{{ route('user.simulasi.details-kab.satker', ['simulation' => $user->simulations_id, 'satker' => $user->satker_1]) }}">

                    {{ $user->satker1->kode_wilayah }} - {{ $user->satker1->name }} -
                    {{ $user->satker1->location->provinsi }}
                </x-link>

                @if ($user->satker_1 == $user->satker_final)
                    {{ view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => true, 'tag' => 'span']) }}
                @endif

            </x-description-list>
        @endif

        @if ($user->satker2)
            <x-description-list title="Pilihan Kedua " class="bg-gray-50">
                <x-link target="_blank"
                    href="{{ route('user.simulasi.details-kab.satker', ['simulation' => $user->simulations_id, 'satker' => $user->satker_2]) }}">

                    {{ $user->satker2->kode_wilayah }} - {{ $user->satker2->name }} -
                    {{ $user->satker2->location->provinsi }}
                </x-link>


                @if ($user->satker_2 == $user->satker_final)
                    {{ view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => true, 'tag' => 'span']) }}
                @endif
            </x-description-list>
        @endif

        @if ($user->satker3)
            <x-description-list title="Pilihan Ketiga">
                <x-link target="_blank"
                    href="{{ route('user.simulasi.details-kab.satker', ['simulation' => $user->simulations_id, 'satker' => $user->satker_3]) }}">

                    {{ $user->satker3->kode_wilayah }} - {{ $user->satker3->name }} -
                    {{ $user->satker3->location->provinsi }}
                </x-link>


                @if ($user->satker_3 == $user->satker_final)
                    {{ view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => true, 'tag' => 'span']) }}
                @endif
            </x-description-list>
        @endif

        @if ($user->user_selection_at)
            <x-description-list title="Memilih pada" class="bg-gray-50">
                {{ $user->user_selection_at->format('l, d-F-Y H:i:s') }}
            </x-description-list>
        @endif

        @if ($user->satker_final)
            <x-description-list title="Pilihan Final">
                <x-link target="_blank"
                    href="{{ route('user.simulasi.details-kab.satker', ['simulation' => $user->simulations_id, 'satker' => $user->satker_final]) }}">

                    {{ $user->satkerfinal->kode_wilayah }} - {{ $user->satkerfinal->name }} -
                    {{ $user->satkerfinal->location->provinsi }}
                </x-link>

            </x-description-list>
        @endif

        @if ($user->satker_final_updated_at)
            <x-description-list title="Satker Final Updated At" class="bg-gray-50">
                {{ $user->satker_final_updated_at->format('l, d-F-Y H:i:s') }}
            </x-description-list>
        @endif

        @if ($user->satker_final_keterangan)
            <b>
                <x-description-list title="Keterangan">
                    {{ $user->satker_final_keterangan }}
                </x-description-list>
            </b>
        @endif

    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
