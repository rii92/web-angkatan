<div>
    <x-modal.header title="Add New Meeting Member" bordered />
    <x-modal.body>
        <form wire:submit.prevent="handleForm">
            <x-input.wrapper x-data="{search : false}">
                <x-input.label for="search" value="Search Mahasiswa" />
                <div class="flex items-center justify-center">
                    <div class="flex-1 relative">
                        <x-input.text id="search" placeholder="2218###@stis.ac.id or John Doe" wire:model="search"
                            x-on:input="search = true" />

                        {{-- dropdown auto search. limit search 2 items, because modal is overflow:hidden --}}
                        @if ($search)
                            <ul x-show="search" @click.away="search = false"
                                class="absolute left-0 w-full bg-white border border-gray-200 rounded-md shadow-sm text-sm">
                                @forelse($users as $u)
                                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                                        wire:click="selectResult('{{ $u->email }}')" x-on:click="search=false">
                                        <p> {{ $u->name }} - <span class="italic">{{ $u->email }}</span>
                                        </p>
                                    </li>
                                @empty
                                    <li class="px-4 py-2 italic">
                                        <p>No user found</p>
                                    </li>
                                @endforelse
                            </ul>
                        @endif
                    </div>
                    <x-button.black type="submit" class="ml-2">
                        Add
                    </x-button.black>
                </div>
                {{-- don't move it --}}
                <x-input.error for="search" />
            </x-input.wrapper>
        </form>

        <form wire:submit.prevent="handleBulk">
            <x-input.wrapper class="mb-4">
                <x-input.label for="role" value="Or select all users in some roles" />
                <div class="flex items-center">
                    <x-input.select wire:model.defer="role">
                        <option>Select Role</option>
                        @foreach (AppRoles::allRoles() as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </x-input.select>
                    <x-button.success class="whitespace-nowrap ml-2" type="submit">Add Member</x-button.success>
                </div>
                <x-input.error for="role" />
            </x-input.wrapper>
        </form>

    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</div>
