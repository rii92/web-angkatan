<div class="p-2 pb-3">
    <x-modal.header title="Update Permission Role {{ $role->name }}" bordered />
    <x-modal.body>
        <p class="mb-2 text-sm">{{ $role->description }}</p>

        <form wire:submit.prevent="addPermission">
            <x-input.wrapper class="mb-4">
                <x-input.label for="role" value="Or add permission" />
                <div class="flex items-center">
                    <x-input.select wire:model.defer="permission">
                        <option value="">Pilih Permission</option>
                        @foreach ($all_permissions as $permission)
                            <option value="{{ $permission }}">
                                {{ Str::of($permission)->replace('_', ' ')->title() }}
                            </option>
                        @endforeach
                    </x-input.select>
                    <x-button.success class="whitespace-nowrap ml-2" type="submit">Add Permission</x-button.success>
                </div>
                <x-input.error for="permission" />
            </x-input.wrapper>
        </form>

        <x-table :theads="['permission', 'Action']" :overflow="false" max-height="max-h-96">
            @forelse ($rolePermissions as $permission)
                <tr class="border-b border-gray-200 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-3 px-6 text-center">
                        <x-badge.success text="{{ Str::of($permission)->replace('_', ' ')->title() }}" />
                    </td>
                    <td class="py-3 px-6 text-center flex justify-center">
                        <x-button.error wire:click="revokePermission('{{ $permission }}')">
                            Revoke
                        </x-button.error>
                    </td>
                </tr>
            @empty
                <tr class=" border-b border-gray-200">
                    <td colspan="2" class="text-center italic text-sm py-3 px-6">Belum ada permission</td>
                </tr>
            @endforelse
        </x-table>

    </x-modal.body>

    <x-modal.footer>
        <div class="mt-2">
            <x-button.secondary wire:click="$emit('closeModal')">
                Close
            </x-button.secondary>
        </div>
    </x-modal.footer>
</div>
