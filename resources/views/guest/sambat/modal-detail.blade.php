<x-modal.body class="sm:mx-5 mx-0.5">
    <div class="lg:grid lg:grid-cols-12">
        <div class="lg:col-span-7" wire:ignore>
            @livewire('guest.sambat.item', ['sambat' => $sambat, 'hideCommentButton' => true])
        </div>

        <div class="lg:col-span-5">
            <div class="mx-2 md:pl-3 md:mx-0">

                <x-sambat.comments :comments="$comments" :sambat="$sambat" />
                
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

                <div class="flex items-center justify-between mt-3">
                    <div>
                        @auth
                            <x-input.checkbox id="isAnonim" wire:model.defer="isAnonim" text="Anonim" />
                        @endauth
                    </div>

                    <div class="flex items-center">
                        <x-button.secondary wire:click="$emit('closeModal')" class="order-2">
                            Tutup
                        </x-button.secondary>

                        @auth
                            <x-button.success type="submit" form="add-comment" class="order-3 ml-2">
                                Kirim
                            </x-button.success>
                        @else
                            <p class="order-1 mr-2 text-sm italic text-center">Login dulu biar bisa ikut komentar...</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modal.body>
