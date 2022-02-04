<form wire:submit.prevent="handleForm">
    @php
        $chatType = $chat->type == AppKonsul::TYPE_CHAT_IMAGE ? 'gambar' : 'pesan';
    @endphp
    <x-modal.header title="Delete {{ ucwords($chatType) }}" />
    <x-modal.body>
        Apakah anda yakin menghapus {{ $chatType }} ini?
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
