<form wire:submit.prevent="handleForm">
    <x-modal.header title="Delete Konsultasi" />
    <x-modal.body>
        Apakah anda yakin menghapus konsultasi ini?
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
