<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $turnitin_id ? __('Update Submission') : __('Add a New Submission') }}" bordered />
    <x-modal.body>

        <x-input.wrapper>
            <x-input.label for="turnitin.link_file" value="{{ __('Link File') }}" />
            <x-input.textarea wire:model.defer="turnitin.link_file" id="description" rows="3" />
            <x-input.caption class="mt-1">
                Silahkan masukkan file yang akan dicek ke drive masing-masing dan copykan linknya ke form ini. Pastikan
                bahwa link tersebut sudah <b>Public</b> sehingga bisa diakses oleh admin.
            </x-input.caption>
            <x-input.error for="turnitin.link_file" />
        </x-input.wrapper>

    </x-modal.body>
    <x-modal.footer>
        <x-button.black type="submit">
            Submit
        </x-button.black>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
