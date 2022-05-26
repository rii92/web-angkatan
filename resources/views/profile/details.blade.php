<x-card.form id="details-information">
    <x-slot name="title">
        {{ __('Update Details Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update Your Details Information, College, and Phone Number') }}
    </x-slot>

    <form wire:submit.prevent="handleForm">
        <x-input.wrapper>
            <x-input.label for="details.nim" value="{{ __('NIM') }}" />
            <x-input.text id="details.nim" value="{{ $details->nim }}" type="text" disabled />
            <x-input.error for="details.nim" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.kelas" value="{{ __('Class') }}" />
            <x-input.text id="details.kelas" value="{{ $details->kelas }}" type="text" disabled />
            <x-input.error for="details.kelas" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.no_hp" value="{{ __('No HP') }}" />
            <x-input.text id="details.no_hp" wire:model.defer="details.no_hp" type="text" />
            <x-input.error for="details.no_hp" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.no_hp_ayah" value="{{ __('No HP Ayah') }}" />
            <x-input.text id="details.no_hp_ayah" wire:model.defer="details.no_hp_ayah" type="text" />
            <x-input.error for="details.no_hp_ayah" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.no_hp_ibu" value="{{ __('No HP Ibu') }}" />
            <x-input.text id="details.no_hp_ibu" wire:model.defer="details.no_hp_ibu" type="text" />
            <x-input.error for="details.no_hp_ibu" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.no_hp_wali" value="{{ __('No HP Wali') }}" />
            <x-input.text id="details.no_hp_wali" wire:model.defer="details.no_hp_wali" type="text" />
            <x-input.error for="details.no_hp_wali" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
            <x-input.select wire:model.defer="details.jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </x-input.select>
            <x-input.error for="details.jenis_kelamin" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.anonim_name" value="{{ __('Anonim Name') }}" />
            <x-input.caption>Nama anonim ini yang akan digunakan ketika menggunakan fitur sambat</x-input.caption>
            <x-input.text id="details.anonim_name" wire:model.defer="details.anonim_name" type="text"
                onkeyup="this.value = this.value.toLowerCase()" />
            <x-input.error for="details.anonim_name" />
        </x-input.wrapper>


        <div class="flex justify-end mt-6 items-center">
            <span class="mr-3 text-sm" wire:loading>Saving...</span>

            <x-button.black type="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>
