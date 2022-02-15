<form wire:submit.prevent="handleForm">
    <x-modal.header title="Delete Sambat" bordered />
    <x-modal.body>
        Apakah anda yakin menghapus sambat ini?

        @if ($route == 'admin')
            <x-input.wrapper>
                <x-input.textarea wire:model.defer="alasan" rows="4" placeholder="Tuliskan alasannya disini" />
                <x-input.error for="alasan" />
            </x-input.wrapper>
        @endif
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
