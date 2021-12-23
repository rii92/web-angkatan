<form wire:submit.prevent="handleForm">
    <x-modal.header title="Publish Announcement" bordered />
    <x-modal.body>
        Apakah anda yakin untuk publish announcement ini sekarang?
    </x-modal.body>
    <x-modal.footer bordered>
        <div class="ml-2">
            <x-button.success type="submit">
                Publish Now
            </x-button.success>
        </div>
        <div class="ml-2">
            <x-button.secondary wire:click="$emit('closeModal')">
                Cancel
            </x-button.secondary>
        </div>
    </x-modal.footer>
</form>
