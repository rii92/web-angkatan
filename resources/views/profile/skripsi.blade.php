<x-card.form>
    <x-slot name="title">
        {{ __('Update Data Skripsi') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update data skripsi dulu cuy') }}
    </x-slot>

    <form wire:submit.prevent="handleForm">
        <x-input.wrapper>
            <x-input.label for="details.skripsi_dosbing" value="{{ __('Dosen Pembimbing') }}" />
            <x-input.text id="details.skripsi_dosbing" wire:model.defer="details.skripsi_dosbing" type="text" />
            <x-input.error for="details.skripsi_dosbing" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.skripsi_judul" value="{{ __('Judul Skripsi') }}" />
            <x-input.textarea id="details.skripsi_judul" wire:model.defer="details.skripsi_judul" rows="3" />
            <x-input.error for="details.skripsi_judul" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.skripsi_metode" value="{{ __('Metode Penelitian') }}" />
            <x-input.textarea id="details.skripsi_metode" wire:model.defer="details.skripsi_metode" rows="3" />
            <x-input.error for="details.skripsi_metode" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.skripsi_variabel_dependent" value="{{ __('Variable Dependent') }}" />
            <x-input.textarea id="details.skripsi_variabel_dependent"
                wire:model.defer="details.skripsi_variabel_dependent" rows="4" />
            <x-input.error for="details.skripsi_variabel_dependent" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.skripsi_variabel_independent" value="{{ __('Variable Independent') }}" />
            <x-input.textarea id="details.skripsi_variabel_independent"
                wire:model.defer="details.skripsi_variabel_independent" rows="4" />
            <x-input.error for="details.skripsi_variabel_independent" />
        </x-input.wrapper>

        <div class="flex justify-end mt-6 items-center">
            <span class="mr-3 text-sm" wire:loading>Saving...</span>

            <x-button.black type="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>
