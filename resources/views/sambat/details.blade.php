<div>
    <x-modal.header title="Sambat" bordered />
    {{-- just move body to a new single page --}}
    <x-modal.body>
        @livewire('sambat.item', ['sambat' => $sambat])
        <h2 class="mb-2">Komentar</h2>
        @forelse ($comments as $comment)
            <div class="flex flex-col justify-between p-4">
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
                        @if (Auth::user()->id == $comment->user->id)    
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

        @if (Auth::check())
            <form wire:submit.prevent="addComments">
                <x-input.wrapper>
                    <x-input.label for="sambat_comments.description" value="{{ __('Komentarmu') }}" />
                    <x-input.text id="sambat_comments.description"></x-input.text>
                    <x-input.error for="sambat_comments.description" />
                </x-input.wrapper>
                <x-button.success onclick="Livewire.emit('submitForm', document.getElementById('sambat_comments.description').value);">Kirim</x-button.success>
            </form>
        @else
            <h1 class="text-center text-md">Login dulu biar bisa ikut komentar...</h1>
        @endif
        
    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">
            Tutup
        </x-button.secondary>
    </x-modal.footer>
</div>
