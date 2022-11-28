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
                    <span>{{ $formation["satker{$f}"]->full_name }}</span>
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
                @if (!$formation->satker_final)
                    <x-badge.error text="Tidak Aman" />
                @else
                    <x-badge.success text="Aman" />
                @endif
                @if ($formation->satker_final_updated_at)
                    <span class="italic">
                        diupdate pada {{ $formation->satker_final_updated_at->format('d-M-Y H:i:s') }}
                    </span>
                @endif
            </x-description-list>
        @endif
        @if ($formation->session_time->start_time <= now() && $formation->session_time->end_time >= now())
            <x-description-list title="Update Pilihan" class="border-b border-gray-100">
                <x-button.primary title="Detail Mahasiswa"
                    onclick="Livewire.emit('openModal', 'mahasiswa.simulation.modal-selection', {{ json_encode(['user_formation_id' => $formation->id]) }})">
                    <span class="text-xs">Update</span>
                </x-button.primary>
            </x-description-list>
        @endif

    </div>
</div>
