@props(['comments'])

<div>
    <h2 class="pb-2 mb-3 border-b">
        Komentar
        @if ($jumlahKomentar = $comments->count())
            <x-badge.warning text="{{ $jumlahKomentar }}" />
        @endif
    </h2>

    <div style="max-height: 60vh" x-data="{}" class="overflow-y-auto divide-y" id="all-comments"
        x-effect="setTimeout(() => {const bottom = $el.lastElementChild.offsetTop; $el.scrollTo({top: bottom, behavior: 'smooth'});}, 100);">

        @forelse ($comments as $comment)
            <div class="flex flex-col justify-between p-4 font-sans hover:bg-gray-50">
                <div class="flex flex-row justify-between items-start">
                    <div class="flex items-center pb-2  ">
                        <div class="w-10 h-10">
                            <img class="object-cover w-full rounded-full mr-2"
                                src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
                        </div>
                        <div class="ml-2">
                            <div class="font-bold text-sm text-gray-600">
                                {{ $comment->user->name }}
                            </div>
                            <div class="text-xs">
                                {{ $comment->created_at->format('d-M H:i') }}
                            </div>
                        </div>
                    </div>

                    <div>
                        @auth
                            @if (Auth::id() == $comment->user_id or Auth::user()->can(AppPermissions::DELETE_SAMBAT))
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex p-1 text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <x-icons.more-vertical width="20" height="20" />
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-jet-dropdown-link class="cursor-pointer"
                                            wire:click="deleteComments({{ $comment->id }})">
                                            {{ __('Delete') }}
                                        </x-jet-dropdown-link>
                                    </x-slot>
                                </x-jet-dropdown>
                            @endif
                        @endauth
                    </div>

                </div>
                <p class="my-2 text-sm">{{ $comment->description }}</p>
            </div>
        @empty
            <p class="text-center text-md italic my-8">Belum ada komentar di sambatan ini...</p>
        @endforelse
    </div>
</div>
