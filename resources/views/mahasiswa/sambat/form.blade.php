<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="dataSambat">
    <x-card.form title="Mari Nyambat">
        @slot('description')
            Pusing sama skripsi? pusing sama kuliah? mari nyambat. Kamu bisa menggunakan fitur anonim juga loh!! Kamu bisa
            mengatur nama anonim kamu <x-link class="text-green-600 font-bold"
                href="{{ route('profile.show') . '#details-information' }}">disini
            </x-link>. Kerahasiaan datamu bakalan
            dijamin, bahkan pihak angkatanpun tidak akan tau kamu siapa. Tapi ingat, sambatan yang kamu buat jangan sampai
            mengandung kebencian, hoax, sara, dan pornografi. Jika hal itu terjadi maka pihak angkatan akan
            men-<i>takedown</i> sambatanmu.
        @endslot
        <form wire:submit.prevent="handleForm">

            <x-input.wrapper>
                <x-input.label for="sambat.description" value="{{ __('Sambatan') }}" />
                <div wire:ignore class="mt-1">
                    <div id="editor"></div>
                </div>
                <x-input.error for="sambat.description" />
            </x-input.wrapper>

            <x-input.wrapper>
                <div class="flex">
                    <x-input.checkbox wire:model.defer="sambat.is_anonim" id="anonim" text="Anonim" />
                    <input type="file" id="input-image" class="hidden" x-ref="image" multiple
                        x-on:change="updateImage" />
                    <x-icons.image class="cursor-pointer ml-2" x-on:click="$refs.image.click()" />
                </div>
                <x-input.error for="images.*" />
            </x-input.wrapper>


            <div class="grid grid-cols-3 gap-1" id="images">
                @foreach ($sambat->images as $image)
                    <div class="h-32 col-span-1 overflow-hidden relative">
                        <img src="{{ Storage::disk('public')->url($image->url) }}"
                            alt="{{ Storage::disk('public')->url($image->url) }}"
                            class="hover:opacity-90 transition cursor-pointer">
                        <x-icons.close title="Hapus" x-on:click="deleteImage('{{ $image->url }}', $el)"
                            class="absolute top-0 right-0 border transition hover:bg-white cursor-pointer bg-gray-100 p-0.5"
                            width="18" height="18" />
                    </div>
                @endforeach

                <template x-for="(photo, index) in photos" :key="index">
                    <div class="h-32 col-span-1 overflow-hidden relative uploaded">
                        <img x-bind:src="photo" x-bind:alt="index" class="hover:opacity-90 transition cursor-pointer">
                        <x-icons.close title="Hapus"
                            class="absolute top-0 right-0 border transition hover:bg-white cursor-pointer bg-gray-100 p-0.5"
                            x-on:click="removeImage(index)" width="18" height="18" />
                    </div>
                </template>
            </div>

            <x-input.wrapper class="mb-5">
                <x-input.label for="hashtags" value="{{ __('Hashtags') }}" />
                <x-input.caption>
                    Maksimal 5 tags untuk menggambarkan sambatanmu berkaitan dengan apa
                </x-input.caption>
                <x-input.tags init="{{ $tags }}" id="hashtags" className="tag" />
                <x-input.error for="hashtags" />
            </x-input.wrapper>

            <div class="flex justify-between mt-4 items-center">
                <p class="text-xs text-gray-500 mr-3">
                    {{ $sambat->updated_at ? "Last Update : {$sambat->updated_at->format('d M Y h:i A')}" : '' }}
                </p>

                <div class="flex items-center">
                    <p wire:loading class="text-gray-400 text-xs italic mr-2">Menyimpan ...</p>
                    <x-anchor.secondary wire:loading.remove href="{{ route('user.sambat.table') }}">Back
                    </x-anchor.secondary>
                    <x-button.black x-on:click="submitForm" class="ml-2" wire:loading.attr="disabled">
                        {{ $sambat_id ? 'Save' : 'Submit' }}
                    </x-button.black>
                </div>
            </div>
        </form>
    </x-card.form>

    @push('scripts')
        <script src="{{ mix('js/editor.js') }}" defer></script>
        <script src="{{ mix('js/viewer.js') }}" defer></script>
        <script>
            const dataSambat = {
                photos: [],
                files: [],
                editor: null,
                viewer: null,
                validExtention: ["jpeg", 'jpg', 'png'],
                deleteUrl: [],

                init() {
                    document.addEventListener("DOMContentLoaded", () => {
                        this.editor = new Editor({
                            el: document.querySelector('#editor'),
                            previewStyle: 'tab',
                            minHeight: '300px',
                            initialValue: @this.sambat.description,
                            toolbarItems: ['bold', 'italic', 'strike', 'hr', 'quote', 'ul', 'ol',
                                'link'
                            ],
                        });

                        this.viewer = new Viewer(document.getElementById('images'), {
                            inline: false,
                            zoomRatio: 0.2
                        });
                    });
                },

                submit() {
                    const tags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent);
                    @this.handleForm(this.editor.getMarkdown(), tags, this.deleteUrl)
                },

                submitForm() {
                    if (this.files.length != 0)
                        @this.uploadMultiple('images', this.files, () => {
                            this.submit();
                        });
                    else
                        this.submit();
                },

                removeImage(index) {
                    this.photos.splice(index, 1);
                    this.files.splice(index, 1);
                    this.updateViewer();
                },

                updateViewer() {
                    setTimeout(() => {
                        this.viewer.update();
                    }, 100);
                },

                updateImage() {
                    Array.from(this.$refs.image.files).forEach((file) => {
                        const fileType = file.type.split('/')[1]
                        const fileSize = file.size / 1024 / 1024;

                        if (!this.validExtention.includes(fileType))
                            return Livewire.emit('error', `Pastikan file ${file.name} adalah file gambar`);

                        if (fileSize > 2)
                            return Livewire.emit('error', `File ${file.name} melebihi 2 MB`);

                        this.files.push(file)
                        const reader = new FileReader();
                        reader.onload = e => this.photos.push(e.target.result);
                        reader.readAsDataURL(file);
                    });
                    this.updateViewer();
                },

                deleteImage(url, element) {
                    element.parentElement.remove()
                    this.deleteUrl.push(url);
                }
            }
        </script>
    @endpush
</div>
