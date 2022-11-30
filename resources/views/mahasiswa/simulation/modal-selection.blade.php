<form wire:submit.prevent="handleForm">
    <x-modal.header title="Update Pilihan Satker" bordered />
    <x-modal.body>
        <x-description-list title="Nama" class="bg-gray-50">
            {{ $userFormation->user->name }}
        </x-description-list>

        <x-description-list title="NIM">
            {{ Str::upper($userFormation->user->details[AppSimulation::BASED_ON]) }} -
            {{ $userFormation->user->details->nim }}
        </x-description-list>

        <x-description-list title="Rangking" class="bg-gray-50">
            {{ $userFormation->user_rank }}
        </x-description-list>

        @foreach ([1, 2, 3] as $f)
            <div class="my-4 mx-6 mb-6">
                <x-input.wrapper>
                    <x-input.label for="userFormation.satker_{{ $f }}"
                        value="Satker pilihan {{ $f }}" />
                    <x-input.select wire:model.defer="userFormation.satker_{{ $f }}">
                        <option value="">Pilih Satuan Kerja</option>
                        @foreach ($satkers as $satker)
                            <option value="{{ $satker->id }}">
                                <span>{{ $satker->full_name }}</span>
                                <span>( {{ $satker->formation_final_count }} /
                                    {{ $satker[strtolower($userFormation->based_on)] }} )</span>
                            </option>
                        @endforeach
                    </x-input.select>
                    <x-input.error for="userFormation.satker_{{ $f }}" />
                </x-input.wrapper>
            </div>
        @endforeach

        <div class="mb-6 mx-6">
            <x-input.wrapper>
                <x-input.checkbox wire:model.defer="confirm" text="Saya yakin pilihan ini sudah fix dan final"></x-input.checkbox>
                <x-input.error for="confirm" />
            </x-input.wrapper>
        </div>

    </x-modal.body>
    <x-modal.footer>
        <x-button.black type="submit">
            Submit
        </x-button.black>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
