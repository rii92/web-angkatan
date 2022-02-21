<x-card.base>
    <form class="mb-4" id="form">
        <x-input.wrapper class=" mb-5">
            <x-input.label for="konsul.title" value="{{ __('Judul') }}" />
            <x-input.caption>
                Jabarkan secara spesifik dan bayangkan kamu sedang bertanya secara langsung kepada konselor
            </x-input.caption>
            <x-input.text wire:model.defer="konsul.title" id="name" type="text" placeholder="{{ $placeholder }}" />
            <x-input.error for="konsul.title" />
        </x-input.wrapper>


        <x-input.wrapper>
            <x-input.label for="konsul.description" value="{{ __('Pokok Masalah yang Dihadapi') }}" />
            <x-input.caption>
                Jelaskan inti permasalahan yang kamu hadapi sehingga dapat membantu konselor untuk menangkap arah
                pembicaraan.
            </x-input.caption>
            <div wire:ignore>
                <div id="editor"></div>
            </div>
            <x-input.error for="konsul.description" />
        </x-input.wrapper>


        <x-input.wrapper class="md:col-span-1">
            <x-input.checkbox wire:model.defer="konsul.is_anonim" text="Bertanya sebagai anonim?" id="is_anonim" />
            <x-input.caption>
                Jika bertanya sebagai anonim maka konselor tidak akan tau nama, nim, dan kelas. Akan tetapi konselor
                akan
                tau infomasi jurusan kamu. Tujuannya untuk membantu mengalokasikan konselor yang tepat buatmu. Kami
                menjamin
                kerahasiaan d atamu.
            </x-input.caption>
        </x-input.wrapper>

        <x-input.wrapper class="mb-5">
            <x-input.label for="hashtags" value="{{ __('Hashtags') }}" />
            <x-input.caption>
                Maksimal 5 tags untuk menggambarkan pertanyaanmu berkaitan dengan apa
            </x-input.caption>
            <x-input.tags init="{{ $tags }}" id="hashtags" className="tag" />
            <x-input.error for="hashtags" />
        </x-input.wrapper>

        <div class="flex justify-between mt-6 items-center">
            <p class="text-xs text-gray-500 mr-3">
                {{ $konsul->updated_at ? "Last Update : {$konsul->updated_at->format('d M Y h:i A')}" : '' }}
            </p>
            <div class="flex items-center">
                <p wire:loading class="text-gray-400 text-xs italic mr-2">Menyimpan ...</p>
                <x-anchor.secondary wire:loading.remove href="{{ route('user.konsultasi.' . $category . '.table') }}">
                    Back
                </x-anchor.secondary>
                <x-button.black wire:loading.attr="disabled" x-on:click="submitForm" class="ml-2">
                    {{ $konsul_id ? 'Save' : 'Submit' }}
                </x-button.black>
            </div>
        </div>

        @push('scripts')
            <script src="{{ mix('js/editor.js') }}" defer></script>
            <script>
                let editor;
                const submitForm = () => {
                    const tags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent);
                    Livewire.emit('submitForm', editor.getMarkdown(), tags);
                }

                document.addEventListener("DOMContentLoaded", function() {
                    editor = new Editor({
                        el: document.querySelector('#editor'),
                        previewStyle: 'tab',
                        height: '300px',
                        initialValue: @this.konsul.description,
                        toolbarItems: ['heading', 'bold', 'italic', 'strike', 'divider', 'hr', 'quote', 'divider',
                            'ul', 'ol', 'task', 'indent', 'outdent', 'divider', 'table', 'link',
                            'divider', 'code', 'codeblock'
                        ],
                    });
                });
            </script>
        @endpush
    </form>
</x-card.base>
