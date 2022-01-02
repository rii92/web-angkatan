<form wire:submit.prevent="handleForm">
    <x-modal.header title="Detail Skripsi" bordered />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="user_details.skripsi_dosbing" value="{{ __('Dosen Pembimbing') }}" />
            <x-input.text id="user_details.skripsi_dosbing" wire:model.defer="user_details.skripsi_dosbing"
                type="text" />
            <x-input.error for="user_details.skripsi_dosbing" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user_details.skripsi_judul" value="{{ __('Judul Skripsi') }}" />
            <x-input.textarea id="user_details.skripsi_judul" wire:model.defer="user_details.skripsi_judul" rows="2" />
            <x-input.error for="user_details.skripsi_judul" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user_details.skripsi_metode" value="{{ __('Metode Penelitian') }}" />
            <x-input.textarea id="user_details.skripsi_metode" wire:model.defer="user_details.skripsi_metode"
                rows="2" />
            <x-input.error for="user_details.skripsi_metode" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user_details.skripsi_variabel_dependent" value="{{ __('Variable Dependent') }}" />
            <x-input.textarea id="user_details.skripsi_variabel_dependent"
                wire:model.defer="user_details.skripsi_variabel_dependent" rows="3" />
            <x-input.error for="user_details.skripsi_variabel_dependent" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user_details.skripsi_variabel_independent" value="{{ __('Variable Independent') }}" />
            <x-input.textarea id="user_details.skripsi_variabel_independent"
                wire:model.defer="user_details.skripsi_variabel_independent" rows="3" />
            <x-input.error for="user_details.skripsi_variabel_independent" />
        </x-input.wrapper>

    </x-modal.body>
    <x-modal.footer>
        <span class="mr-3 text-sm" wire:loading>Saving...</span>
        <x-button.black type="submit">
            Submit
        </x-button.black>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
