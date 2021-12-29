<x-card.form>
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <form wire:submit.prevent="updatePassword">
        <x-input.wrapper>
            <x-input.label for="current_password" value="{{ __('Current Password') }}" />
            <x-input.password id="current_password" wire:model.defer="state.current_password" type="password"
                autocomplete="current_password" />
            <x-input.error for="current_password" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="password" value="{{ __('New Password') }}" />
            <x-input.password id="password" type="password" wire:model.defer="state.password" required
                autocomplete="new-password" />
            <x-input.error for="password" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input.password id="password_confirmation" type="password" wire:model.defer="state.password_confirmation"
                required autocomplete="new-password" />
            <x-input.error for="password_confirmation" />
        </x-input.wrapper>

        <div class="flex justify-end mt-6 items-center">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-button.black type="submit">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>
