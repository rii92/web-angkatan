<div>
    <form wire:submit.prevent="handleForm">
        <x-modal.header title="Update Role" />
        <x-modal.body>
            <div class="grid grid-cols-4">
                @foreach ($all_roles as $item)
                <x-input.checkbox wire:model="roles" value="{{ $item }}" text="{{ $item }}"
                    :disabled="$item == 'users'" />
                @endforeach
            </div>
        </x-modal.body>
        <x-modal.footer bordered>
            <x-button.success type="submit">
                Update
            </x-button.success>

            <x-button.secondary wire:click="$emit('closeModal')">
                Cancel
            </x-button.secondary>
        </x-modal.footer>
    </form>
</div>
