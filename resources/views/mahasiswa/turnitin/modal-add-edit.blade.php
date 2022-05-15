<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $turnitin_id ? __('Update Submission') : __('Add a New Submission') }}" bordered />
    <x-modal.body>

        <x-input.wrapper>
            <x-input.label for="turnitin.link_file" value="{{ __('Link File') }}" />
            <x-input.textarea wire:model.defer="turnitin.link_file" id="description" rows="3" />
            <x-input.caption class="mt-1">

                Silahkan masukkan file yang akan dicek ke drive masing-masing dan copykan linknya ke form ini.
                Perhatikan beberapa hal berikut
                <ol class="text-sm list-decimal list-inside text-gray-400">
                    <li> File berekstensi
                        <x-badge.primary text=".pdf" />
                    </li>
                    <li>Format nama file <b>Nama-Kelas-NIM</b></li>
                    <li>JIka filenya ada banyak (terdapat bab 1, bab 2, bab 3, dan bab 4) silahkan digabungkan terlebih
                        dahulu sehingga pengajuan cukup dilakukan dalam 1 submission saja.</li>
                    <li>Pastikan bahwa link tersebut sudah <b>Public</b> sehingga bisa diakses oleh admin.</li>
                </ol>
            </x-input.caption>
            <x-input.error for="turnitin.link_file" />
        </x-input.wrapper>

    </x-modal.body>
    <x-modal.footer>
        <x-button.black type="submit">
            Submit
        </x-button.black>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
