<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $simulation_id ? __('Update Simulation') : __('Add a New Simulation') }}" bordered />

    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="simulation.title" value="{{ __('Title') }}" />
            <x-input.text wire:model.defer="simulation.title" id="simulation.title" type="text" />
            <x-input.error for="simulation.title" />
        </x-input.wrapper>

        @foreach ($simulation_times as $index => $times)
            <div class="grid md:grid-cols-2 md:gap-x-2" wire:key="times-field-{{ $times->id ?? $index }}">
                <x-input.wrapper>
                    <x-input.label for="simulation_times.{{ $index }}.start_time"
                        value="Waktu mulai sesi {{ $index }}" />
                    <x-input.text wire:model.defer="simulation_times.{{ $index }}.start_time"
                        id="simulation_times.{{ $index }}.start_time" type="datetime-local" />
                    <x-input.error for="simulation_times.{{ $index }}.start_time" />
                </x-input.wrapper>

                <x-input.wrapper>
                    <x-input.label for="simulation_times.{{ $index }}.end_time"
                        value="Waktu berakhir sesi {{ $index }}" />
                    <x-input.text wire:model.defer="simulation_times.{{ $index }}.end_time"
                        id="simulation_times.{{ $index }}.end_time" type="datetime-local" />
                    <x-input.error for="simulation_times.{{ $index }}.end_time" />
                </x-input.wrapper>
            </div>
        @endforeach


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
