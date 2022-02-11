<div x-data="{status : ''}">
    <x-input.wrapper>
        <x-input.caption>
            Apakah kamu menerima pengajuan konsultasi ini? Jika tidak silahkan jabarkan alasannya agar mahasiswa
            tersebut tau alasannya, misalnya pertanyaan sudah pernah ditanyakan atau pertanyaan tidak jelas.
        </x-input.caption>

        <x-input.select wire:model.defer="status" id="status" x-model="status" onchange="openEditorNote(this.value)">
            <option value="">Pilih Status</option>
            <option value="{{ AppKonsul::STATUS_PROGRESS }}">Terima</option>
            <option value="{{ AppKonsul::STATUS_REJECT }}">Ditolak</option>
        </x-input.select>
        <x-input.error for="status" />
    </x-input.wrapper>

    <template x-if="status == '{{ AppKonsul::STATUS_REJECT }}'">
        <div class="mt-2">
            <div wire:ignore>
                <div id="note-editor"></div>
            </div>
            <x-input.error for="note" />
        </div>
    </template>

    <div class="flex justify-end mt-6 items-center">
        <div class="flex items-center">
            <p wire:loading class="text-gray-400 text-xs italic mr-2">Menyimpan ...</p>
            <x-anchor.secondary wire:loading.attr="disabled"
                href="{{ route('admin.konsultasi.' . $konsul->category . '.table') }}">
                Back
            </x-anchor.secondary>
            <x-button.black wire:loading.attr="disabled" x-on:click="submitForm" class="ml-2">
                Ubah Status
            </x-button.black>
        </div>
    </div>

    @push('scripts')
        <script>
            let noteEditor;
            const submitForm = () => Livewire.emit('submitForm', noteEditor ? noteEditor.getMarkdown() : '');

            const openEditorNote = (status) => {
                if (status == "<?= AppKonsul::STATUS_REJECT ?>") {
                    setTimeout(() => {
                        noteEditor = new Editor({
                            el: document.querySelector('#note-editor'),
                            previewStyle: 'tab',
                            height: '200px',
                            placeholder: "Alasanya apa?",
                            toolbarItems: ['heading', 'bold', 'italic', 'strike', 'divider',
                                'hr',
                                'quote',
                                'divider',
                                'ul', 'ol', 'task', 'indent', 'outdent', 'divider', 'table',
                                'link',
                                'divider', 'code', 'codeblock'
                            ],
                        });
                    }, 1);
                }
            }
        </script>
    @endpush
</div>
