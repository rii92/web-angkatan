<x-modal.body class="sm:mx-5 mx-1">
    <div class="lg:grid lg:grid-cols-12">
        <div class="lg:col-span-7">
            @livewire('guest.sambat.item', ['sambat' => $sambat, 'hideCommentButton' => true])
        </div>

        <div class="lg:col-span-5">
            <div class="pl-3">
                <x-sambat.comments :comments="$comments" />

                @auth
                    <form wire:submit.prevent="addComments" id="add-comment">
                        <x-input.wrapper>
                            <x-input.textarea rows="3" id="sambatComment" wire:model.defer="sambatComment"
                                placeholder="{{ __('Komentarmu...') }}">
                            </x-input.textarea>
                            <x-input.error for="sambatComment" />
                        </x-input.wrapper>
                    </form>
                @endauth

                <div class="flex justify-end items-center mt-3">
                    @auth
                        <x-button.success type="submit" form="add-comment">
                            Kirim
                        </x-button.success>
                    @else
                        <p class="text-center text-sm italic">Login dulu biar bisa ikut komentar...</p>
                    @endauth
                    <x-button.secondary wire:click="$emit('closeModal')" class="ml-2">
                        Tutup
                    </x-button.secondary>
                </div>
            </div>
        </div>
    </div>
</x-modal.body>
