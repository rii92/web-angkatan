<div class="my-2 mx-2 mb-4 flex-1">
    <div class="bg-white sm:rounded-lg shadow-lg h-full">
        <x-description-list title="Nama" class="border-b border-gray-100">
            {{ $user->name }} - {{ Str::upper($user->details[AppSimulation::BASED_ON]) }} -
            ({{ $user->details->nim }})
        </x-description-list>
        <x-description-list title="Rangking" class="border-b border-gray-100">
            {{ $formation->user_rank }} / {{ $max_rank }}
        </x-description-list>
        <x-description-list title="Sesi Pemilihan" class="border-b border-gray-100">
            <span>Sesi {{ $formation->session + 1 }}</span>
            <span>
                ({{ $formation->session_time->start_time->format('d-M-Y H:i') }} -
                {{ $formation->session_time->end_time->format('d-M-Y H:i') }} WIB)
            </span>
        </x-description-list>
        @foreach ([1, 2, 3] as $f)
            <x-description-list title="Pilihan {{ $f }}" class="border-b border-gray-100">
                @if ($formation["satker{$f}"])
                    <?php $satker = "satker_{$f}"; ?>

                    <x-link target="_blank"
                        href="{{ route('user.simulasi.details-kab.satker', ['simulation' => $formation->simulations_id, 'satker' => $formation->{$satker}]) }}">

                        <span>{{ $formation["satker{$f}"]->full_name }} -
                            {{ $formation["satker{$f}"]->location->provinsi }}</span>
                    </x-link>
                    @if ($formation["satker_{$f}"] === $formation->satker_final)
                        <x-badge.success text="Terpilih" />
                    @endif
                @else
                    <x-badge.error text="Belum Memilih" />
                @endif
            </x-description-list>
        @endforeach
        @if ($formation->satker_1)
            <x-description-list title="Status" class="border-b border-gray-100">
                {{ view('mahasiswa.simulation.column.status-pilihan', ['status_pilihan' => $formation->status_pilihan]) }}

                @if ($formation->user_selection_at)
                    <div class="italic">
                        memilih pada {{ $formation->user_selection_at->format('d-M-Y H:i:s') }}
                    </div>
                @endif

                @if ($formation->satker_final_updated_at)
                    <div class="italic">
                        hasil diupdate pada {{ $formation->satker_final_updated_at->format('d-M-Y H:i:s') }}
                        @if (!$formation->satker_final_completed)
                            <x-badge.warning text="Job is Running" />
                        @endif
                    </div>
                @endif

            </x-description-list>
        @endif

        @if ($formation->satker_final_keterangan)
            <x-description-list title="Keterangan" class="border-b border-gray-100">
                {{ $formation->satker_final_keterangan }}
            </x-description-list>
        @endif

        <x-description-list title="Update Pilihan" class="border-b border-gray-100">
            @if ($formation->session_time->start_time > now())
                <x-badge.warning text="Belum Mulai" />
            @endif
            @if ($formation->session_time->start_time <= now() && $formation->session_time->end_time >= now())
                <div class="flex items-center">
                    <x-button.primary title="Detail Mahasiswa"
                        onclick="Livewire.emit('openModal', 'mahasiswa.simulation.modal-selection', {{ json_encode(['user_formation_id' => $formation->id]) }})">
                        <span class="text-xs">Update</span>
                    </x-button.primary>

                    <x-icons.refresh
                        class="text-gray-500 ml-2 cursor-pointer transform transition-transform duration-1000 hover:rotate-180 mr-2"
                        onclick="Livewire.emit('reloadComponents', 'mahasiswa.simulation.selection')" />

                </div>
            @endif
            @if ($formation->session_time->end_time < now())
                <x-badge.error text="Sesi Habis" />
            @endif
        </x-description-list>

    </div>
</div>
