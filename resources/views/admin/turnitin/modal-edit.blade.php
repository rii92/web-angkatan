<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="Updated Status Pengajuan" bordered />
    <x-modal.body>

        @if (in_array($turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REVISI_LINK]))
            <x-input.wrapper>
                <x-input.label for="status" value="{{ __('Status') }}" />
                <x-input.select wire:model.defer="status" id="status">
                    <option value="">Pilih Status</option>
                    @if ($turnitin->status != AppTurnitins::STATUS_REVISI_LINK)
                        <option value="{{ AppTurnitins::STATUS_REVISI_LINK }}">
                            {{ ucwords(AppTurnitins::STATUS_REVISI_LINK) }}
                        </option>
                    @endif
                    <option value="{{ AppTurnitins::STATUS_REJECT }}">{{ ucwords(AppTurnitins::STATUS_REJECT) }}
                    </option>
                    <option value="{{ AppTurnitins::STATUS_PROGRESS }}">{{ ucwords(AppTurnitins::STATUS_PROGRESS) }}
                    </option>
                </x-input.select>
                <x-input.error for="status" />
            </x-input.wrapper>
        @endif

        @if (in_array($turnitin->status, [AppTurnitins::STATUS_PROGRESS, AppTurnitins::STATUS_DONE]))
            <x-input.wrapper>
                <x-input.label for="turnitin.link_hasil" value="{{ __('Link Hasil Pengecekan') }}" />
                <x-input.textarea wire:model.defer="turnitin.link_hasil" id="link_hasil" rows="3" />
                <x-input.error for="turnitin.link_hasil" />
            </x-input.wrapper>
        @endif

        @if ($turnitin->status != AppTurnitins::STATUS_DONE && $turnitin->status != AppTurnitins::STATUS_PROGRESS)
            <x-input.wrapper>
                <x-input.label for="note" value="{{ __('Catatan') }}" />
                <x-input.textarea wire:model.defer="note" id="note" rows="3" />
                <x-input.error for="note" />
            </x-input.wrapper>
        @endif


    </x-modal.body>
    <x-modal.footer>
        @if ($turnitin->status != AppTurnitins::STATUS_PROGRESS)
            <x-button.black type="submit">
                Submit
            </x-button.black>
        @else
            <x-button.success type="submit">
                Selesaikan Pengajuan
            </x-button.success>
        @endif

        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
