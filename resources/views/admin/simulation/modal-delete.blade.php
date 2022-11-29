<form wire:submit.prevent="handleForm">
    <x-modal.header title="Delete Simulation" bordered />
    <x-modal.body>
        Apakah anda yakin menghapus simulasi ini? Seluruh data termasuk pilihan dari mahasiswa pada simulasi ini <b>
            akan
            dihapus dan tidak dapat dikembalikan</b> .
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
