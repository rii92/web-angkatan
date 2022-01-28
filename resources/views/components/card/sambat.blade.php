<div title="{{ $sambat->user->name }}"
    class="block md:flex flex-row-reverse pb-2 md:pb-4 mb-4 border-b border-gray-200 ">
    {{-- body --}}
    <div class="flex-1 py-4 px-2 md:ml-2 hover:bg-gray-50 transition duration-100">
        <div class="flex items-center pb-2  ">
            <div class="w-10 h-10">
                <img class="object-cover w-full rounded-full mr-2" src="{{ $sambat->user->profile_photo_url }}"
                    alt="{{ $sambat->user->name }}" />
            </div>
            <div class="ml-2">
                <div class="font-bold text-sm text-gray-600">
                    {{ $sambat->user->name }}
                </div>
                <div class="text-xs">
                    {{ $sambat->created_at }}
                </div>
            </div>
        </div>
        <div class="my-2">
            @foreach ($sambat->tags as $tag)
                <x-badge.black text="{{ $tag->name }}" />
            @endforeach
        </div>
        <div>
            <div class="prose">
                @if ($sambat->image)
                    <div class="mb-2">
                        <img src="{{ Storage::disk('public')->url($sambat->image->url) }}" alt="{{ $sambat->id }}">
                    </div>
                @endif
                {!! Str::markdown($sambat->description) !!}
            </div>
        </div>
    </div>
    {{-- side --}}
    <div class="w-16 py-2 ml-2 md:ml-0 md:py-4 flex justify-start md:border-r border-gray-200">
        <div class="flex md:flex-col items-center">
            <x-button.white title="upvote" wire:click="upvote">
                <x-icons.arrow-up class="w-4 h-4" />
            </x-button.white>
            <div class="text-xs my-2 mx-2">
                10
            </div>
            <x-button.white title="downvote" wire:click="downvote">
                <x-icons.arrow-down class="w-4 h-4" />
            </x-button.white>
            <x-button.white title="comment"
                onclick="Livewire.emit('openModal', 'sambat.details', {{ json_encode(['sambat_id' => $sambat->id]) }})"
                class="ml-2 mt-0 md:ml-0 md:mt-2">
                <x-icons.chat class="w-4 h-4" />
            </x-button.white>
            <x-anchor.white title="edit" href="{{ route('user.sambat.edit', $sambat) }}"
                class="ml-2 mt-0 md:ml-0 md:mt-2">
                <x-icons.edit class="w-4 h-4" />
            </x-anchor.white>
            <x-button.white title="delete"
                onclick="Livewire.emit('openModal', 'sambat.modal-delete', {{ json_encode(['sambat_id' => $sambat->id]) }})"
                class="ml-2 mt-0 md:ml-0 md:mt-2">
                <x-icons.delete class="w-4 h-4" />
            </x-button.white>
        </div>
    </div>
</div>
