<div>
    <div class="mt-2" x-effect="openChatEditor()">
        <div wire:ignore>
            <div id="chat-editor"></div>
        </div>
        <x-input.error for="chat" />
    </div>

    <div class="flex justify-end mt-6 items-center">
        <div class="flex items-center">
            <p wire:loading class="text-gray-400 text-xs italic mr-2">Mengirim ...</p>
            <x-anchor.secondary wire:loading.attr="disabled" href="{{ $routeBack }}">
                Back
            </x-anchor.secondary>
            <x-button.black wire:loading.attr="disabled" x-on:click="submitFormChat" class="ml-2">
                Kirim
            </x-button.black>
        </div>
    </div>
</div>
