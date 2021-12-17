<div class="p-2 pb-3">
    <x-modal.header title="Update Permission Role {{ $role->name }}" bordered />
    <x-modal.body>
        <p class="mb-2 text-sm">{{ $role->description }}</p>

        <form wire:submit.prevent="addPermission">
            <div class="flex items-center mb-4">
                <x-input.select wire:model.defer="permissionToAdd">
                    <option>Pilih Permission</option>
                    @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </x-input.select>
                <x-button.success class="whitespace-nowrap" type="submit">Add Permission</x-button.success>
            </div>
        </form>

        <x-table :theads="['permission', 'Action']" :overflow="false" max-height="max-h-96">
            @forelse ($rolePermissions as $permission)
            <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                <td class="py-3 px-6 text-center">
                    <small class="bg-green-500 text-xs p-1 px-3 rounded-full whitespace-nowrap text-white">{{
                        $permission}}</small>
                </td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center">
                        @if ($role->name != ROLE_ADMIN)
                        <x-button.error class="text-sm" wire:click="revokePermission('{{ $permission }}')">
                            Revoke</x-button.error>
                        @else
                        -
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr class=" border-b border-gray-200 hover:bg-blueGray-100">
                <td colspan="2" class="text-center italic text-sm py-3 px-6">Belum ada permission</td>
            </tr>
            @endforelse
        </x-table>

    </x-modal.body>

    <x-modal.footer bordered>
        <div class="mt-2">
            <x-button.secondary wire:click="$emit('closeModal')">
                Cancel
            </x-button.secondary>
        </div>
    </x-modal.footer>
</div>
