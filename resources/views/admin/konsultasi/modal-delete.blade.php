<form wire:submit.prevent="handleForm">
    <x-modal.header title="Delete Konsultasi" />
    <x-modal.body>
        Apakah anda yakin menghapus konsultasi ini? Harap menggunakan fitur ini jika memang pertanyaan yang diajukan
        sangat tidak berbobot

        <x-input.wrapper>
            <x-input.textarea wire:model.defer="alasan" rows="4" placeholder="Tuliskan alasannya disini" />
            <x-input.error for="alasan" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <div class="ml-2">
            <x-button.error type="submit">
                Delete
            </x-button.error>
        </div>
        <div class="ml-2">
            <x-button.secondary wire:click="$emit('closeModal')">
                Cancel
            </x-button.secondary>
        </div>
    </x-modal.footer>
</form>
