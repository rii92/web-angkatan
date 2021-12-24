<div>
    <x-modal.header title="Delete or Update Status Memeber" />
    <x-modal.body>
        <form wire:submit.prevent="handleStatus">
            <x-input.wrapper>
                <x-input.label for="meetingMember.status" value="Update Status" />
                <div class="flex items-center mb-4">
                    <x-input.select wire:model.defer="meetingMember.status">
                        <option value="">Pilih Permission</option>
                        @foreach (AppMeetings::allStatus() as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </x-input.select>
                    <x-button.success class="whitespace-nowrap ml-2" type="submit">Update Status</x-button.success>
                </div>
            </x-input.wrapper>
        </form>
        <form wire:submit.prevent="handleDelete">
            <div class="md:flex md:items-center">
                <div class="flex-1 text-sm">
                    Or delete this record
                </div>
                <div class="ml-2">
                    <x-button.error type="submit">
                        Delete
                    </x-button.error>
                </div>
            </div>
        </form>
    </x-modal.body>
    <x-modal.footer bordered>
        <div class="ml-2">
            <x-button.secondary wire:click="$emit('closeModal')">
                Cancel
            </x-button.secondary>
        </div>
    </x-modal.footer>
</div>
