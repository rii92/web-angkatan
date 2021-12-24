<div>
    <x-modal.header title="Update Role dan Permission" bordered />
    <x-modal.body>
        <form wire:submit.prevent="handleForm" class="mb-4">
            <div class="grid md:grid-cols-3 grid-cols-2 gap-y-2">
                @foreach ($all_roles as $item)
                    <x-input.checkbox wire:model="roles" value="{{ $item }}" text="{{ $item }}"
                        :disabled="$item == 'users'" />
                @endforeach
            </div>
            <div class="flex justify-end mt-4">
                <x-button.primary type="submit">Update Role</x-button.primary>
            </div>
        </form>

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
            @forelse ($userPermissions as $permission)
                <tr class="border-b border-gray-200 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-3 px-6 text-center">
                        <x-badge.success text="{{ Str::of($permission)->replace('_', ' ')->title() }}" />
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center">
                            <x-button.error wire:click="revokePermission('{{ $permission }}')">
                                Revoke
                            </x-button.error>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class=" border-b border-gray-200">
                    <td colspan="2" class="text-center italic text-sm py-3 px-6">
                        Belum ada permission khusus untuk user ini
                    </td>
                </tr>
            @endforelse
        </x-table>
    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>

</div>
