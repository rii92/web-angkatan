<x-card.form>
    <x-slot name="title">
        {{ __('Update Details Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update Your Details Information, College, and Phone Number') }}
    </x-slot>

    <form wire:submit.prevent="handleForm">
        <x-input.wrapper>
            <x-input.label for="details.nim" value="{{ __('NIM') }}" />
            <x-input.text id="details.nim" wire:model.defer="details.nim" type="text" />
            <x-input.error for="details.nim" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.kelas" value="{{ __('Class') }}" />
            <x-input.text id="details.kelas" wire:model.defer="details.kelas" type="text" />
            <x-input.error for="details.kelas" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.no_hp" value="{{ __('Phone Number') }}" />
            <x-input.text id="details.no_hp" wire:model.defer="details.no_hp" type="text" />
            <x-input.error for="details.no_hp" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
            <x-input.select wire:model="details.jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </x-input.select>
            <x-input.error for="details.jenis_kelamin" />
        </x-input.wrapper>


        <div class="flex justify-end mt-6 items-center">
            <span class="mr-3 text-sm" wire:loading>Saving...</span>

            <x-button.black type="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>