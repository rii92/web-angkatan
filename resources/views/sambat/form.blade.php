<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-card.form title="Mari Nyambat">
        @slot('description')
            Pusing sama skripsi? pusing sama kuliah? mari nyambat
        @endslot
        <form wire:submit.prevent="handleForm">

            <x-input.wrapper>
                <x-input.label for="tags" value="{{ __('Tags') }}" />
                <x-input.text wire:model.defer="tags" />
                <x-input.error for="tags" />
            </x-input.wrapper>

            <div x-data="{ 'image' : 'Choose File', photoPreview: null }">
                <x-input.wrapper>
                    <x-input.label for="image" value="{{ __('Image') }}" />
                    <div class="w-full">
                        <input type="file" id="image" class="hidden" x-ref="image" wire:model="image"
                            x-on:change="
                            image = $refs.image.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.image.files[0]);
                            " />
                        <div class="flex divide-x-1 border rounded-md shadow-sm border-gray-300 justify-between">
                            <span class="text-gray-400 text-sm p-2 overflow-hidden whitespace-nowrap" x-text="image">
                            </span>
                            <x-button.success x-on:click.prevent="$refs.image.click()">
                                File
                            </x-button.success>
                        </div>
                    </div>
                    <x-input.error for="image" />
                </x-input.wrapper>

                @if ($sambat->image)
                    <div class="aspect-w-3 aspect-h-2 mt-1" x-show="!photoPreview">
                        <img src="{{ Storage::disk('public')->url($sambat->image->url) }}" alt="{{ $sambat->id }}">
                    </div>
                @endif

                <div class="aspect-w-3 aspect-h-2 mt-1" x-show="photoPreview">
                    <div class="bg-cover bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </div>
                </div>
            </div>

            <x-input.wrapper>
                <x-input.checkbox wire:model.defer="sambat.is_anonim" id="anonim" text="Anonim" />
                <x-input.error for="sambat.is_anonim" />
            </x-input.wrapper>


            <x-input.wrapper>
                <x-input.label for="sambat.description" value="{{ __('Sambatan') }}" />
                <div wire:ignore class="mt-1">
                    <div id="editor"></div>
                </div>
                <x-input.error for="sambat.description" />
            </x-input.wrapper>

            <x-button.black onclick="submitForm()">
                Submit
            </x-button.black>

            @push('scripts')
                <script src="{{ mix('js/editor.js') }}" defer></script>
                <script>
                    let editor;
                    const submitForm = () => Livewire.emit('submitForm', editor.getMarkdown());

                    document.addEventListener("DOMContentLoaded", function() {
                        editor = new Editor({
                            el: document.querySelector('#editor'),
                            previewStyle: 'tab',
                            height: '500px',
                            initialValue: @this.sambat.description,
                            toolbarItems: ['heading', 'bold', 'italic', 'strike', 'divider', 'hr', 'quote', 'divider',
                                'ul', 'ol', 'task', 'indent', 'outdent', 'divider', 'table', 'link',
                                'divider', 'code', 'codeblock'
                            ],
                        });
                    });
                </script>

            @endpush
        </form>
    </x-card.form>
</div>
