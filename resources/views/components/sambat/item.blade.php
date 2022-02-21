@php
    $name = $sambat->is_anonim ? $sambat->userdetails->anonim_name_value : $sambat->user->name;
    $photo = $sambat->is_anonim ? url('img/user-avatar.svg') : $sambat->user->profile_photo_url;
@endphp

<div title="{{ $name }}" class="block md:flex flex-row-reverse pb-2 md:pb-4 mb-4 border-b border-gray-200">

    <div class="flex-1 md:py-4 px-2 md:ml-2 transition duration-100 md:border-r" wire:ignore>
        <x-sambat.item-body :sambat="$sambat" name="{{ $name }}" photo="{!! $photo !!}" />
    </div>

    {{-- side --}}
    <div class="md:w-16 w-auto pt-3 md:pt-2 pb-2 ml-2 md:ml-0 md:py-4 md:border-r border-gray-200">
        <div class="flex md:flex-col items-center justify-between">
            <div class="flex md:flex-col items-center">
                <x-sambat.icon-vote isSelected="{{ !is_null($sambat_vote) and $sambat_vote->votes == 1 }}"
                    type="upvote" wire:click="upvote" />

                <div class="text-sm my-2 mx-2">
                    {{ $votes_sum }}
                </div>

                <x-sambat.icon-vote isSelected="{{ !is_null($sambat_vote) and $sambat_vote->votes == -1 }}"
                    type="downvote" wire:click="downvote" />
            </div>

            <div class="flex md:flex-col items-center">
                @if (!$hideCommentButton)
                    <x-button.white title="comment"
                        onclick="Livewire.emit('openModal', 'guest.sambat.modal-detail', {{ json_encode(['sambat_id' => $sambat->id, 'route' => 'guest']) }})"
                        class="ml-2 mt-0 md:ml-0 md:mt-2 md:order-1 order-4">
                        <div class="relative">
                            @if ($comments_count)
                                <div class="absolute -right-6 -top-4 text-sm">
                                    <x-badge.warning text="{{ $comments_count }}" />
                                </div>
                            @endif
                            <x-icons.chat class="w-4 h-4" />
                        </div>
                    </x-button.white>
                @endif

                @auth
                    @if (Auth::id() == $sambat->user_id)
                        <x-anchor.white title="edit" href="{{ route('user.sambat.edit', $sambat) }}"
                            class="ml-2 mt-0 md:ml-0 md:mt-2 order-2">
                            <x-icons.edit class="w-4 h-4" />
                        </x-anchor.white>
                    @endif

                    @if (Auth::id() == $sambat->user_id)
                        <x-button.white title="delete"
                            onclick="Livewire.emit('openModal', 'guest.sambat.modal-delete', {{ json_encode(['sambat_id' => $sambat->id, 'route' => 'guest']) }})"
                            class="ml-2 mt-0 md:ml-0 md:mt-2 order-3">
                            <x-icons.delete class="w-4 h-4" />
                        </x-button.white>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
