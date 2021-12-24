<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $meeting_id ? __('Update Meeting') : __('Add a New Meeting') }}" bordered />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="meeting.name" value="{{ __('Meetings Name') }}" />
            <x-input.text wire:model.defer="meeting.name" id="name" type="text" />
            <x-input.error for="meeting.name" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="meeting.description" value="{{ __('Description') }}" />
            <x-input.textarea wire:model.defer="meeting.description" id="description" rows="4" />
            <x-input.error for="meeting.description" />
        </x-input.wrapper>

        <x-input.wrapper class="mb-4">
            <x-input.checkbox wire:model.defer="meeting.is_open" text="Form is open"></x-input.checkbox>
            <x-input.error for="meeting.is_open" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="meeting.started_at" value="{{ __('Meetings Date and Time') }}" />
            <x-input.text wire:model.defer="meeting.started_at" id="started_at" type="datetime-local" />
            <x-input.error for="meeting.started_at" />
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
