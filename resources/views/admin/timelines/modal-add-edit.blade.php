<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $timeline_id ? __('Update Timeline') : __('Add a New Timeline') }}" bordered />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="timeline.title" value="{{ __('Timelines Title') }}" />
            <x-input.text wire:model.defer="timeline.title" id="title" type="text" />
            <x-input.error for="timeline.title" />
        </x-input.wrapper>

        <div class="grid md:grid-cols-2 md:gap-x-2">
            <x-input.wrapper>
                <x-input.label for="timeline.start_date" value="{{ __('Start Date') }}" />
                <x-input.text wire:model.defer="timeline.start_date" id="start_date" type="date" />
                <x-input.error for="timeline.start_date" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="timeline.end_date" value="{{ __('End Date') }}" />
                <x-input.text wire:model.defer="timeline.end_date" id="end_date" type="date" />
                <x-input.error for="timeline.end_date" />
            </x-input.wrapper>
        </div>

        <x-input.wrapper>
            <x-input.label for="timeline.color" value="{{ __('Color in Calendar') }}" />
            <x-input.select wire:model.defer="timeline.color">
                <option value="">Select Color</option>
                @foreach ($colors as $color)
                    <option value="{{ $color }}">{{ ucfirst(str_replace('calendar-', '', $color)) }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="timeline.color" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="timeline.description" value="{{ __('Description') }}" />
            <x-input.textarea wire:model.defer="timeline.description" id="description" rows="4" />
            <x-input.error for="timeline.description" />
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
