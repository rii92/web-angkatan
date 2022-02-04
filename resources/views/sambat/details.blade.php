<div>
    <x-modal.header title="Sambat" bordered />
    {{-- just move body to a new single page --}}
    <x-modal.body>
        @livewire('sambat.item', ['sambat' => $sambat, 'hideCommentButton' => true])
        <h2 class="mb-2">Komentar</h2>
        @forelse ($comments as $comment)
            <div class="flex flex-col justify-between p-4 font-sans">
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
                                {{ $comment->created_at }}
                            </div>
                        </div>
                    </div>
                    <div>
                        @auth
                            @if (Auth::user()->id == $comment->user->id or Auth::user()->can(AppPermissions::DELETE_SAMBAT))
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
            <h1 class="text-center text-md">Belum ada komentar di sambatan ini...</h1>
        @endforelse

        <div class="mb-2">
            {{ $comments->links() }}
        </div>
        @auth
            <form wire:submit.prevent="addComments">
                <x-input.wrapper>
                    <x-input.textarea id="sambat_comments.description" placeholder="{{ __('Komentarmu...') }}">
                    </x-input.textarea>
                    <x-input.error for="sambat_comments.description" />
                </x-input.wrapper>
            </form>
        @else
            <div class="text-center text-md">Login dulu biar bisa ikut komentar...</div>
        @endauth

    </x-modal.body>
    <x-modal.footer>
        @auth
            <x-button.success
                onclick="Livewire.emit('submitForm', document.getElementById('sambat_comments.description').value); document.getElementById('sambat_comments.description').value = ''; ">
                Kirim
            </x-button.success>
        @endauth
        <x-button.secondary wire:click="$emit('closeModal')" class="ml-2">
            Tutup
        </x-button.secondary>
    </x-modal.footer>
</div>
