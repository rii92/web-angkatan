<div>
    <x-modal.header title="Riwayat Pengajuan" bordered />
    <x-modal.body>

        <div style="max-height: 60vh" class="overflow-y-auto">
            <x-activity.wrapper>
                @foreach ($turnitin->activity as $userActivity)
                    <x-activity.list :activity="$userActivity" />
                @endforeach
            </x-activity.wrapper>
        </div>


        @if ($turnitin->status == AppTurnitins::STATUS_REVISI_LINK || ($turnitin->status == AppTurnitins::STATUS_PROGRESS && $isAdmin))
            <x-input.wrapper>
                <x-input.textarea wire:model.defer="komentar" id="komentar" rows="2"
                    placeholder="Tuliskan komentar/pesanmu" />
                <x-input.error for="komentar" />
            </x-input.wrapper>
        @endif

    </x-modal.body>
    <x-modal.footer bordered>
        @if ($turnitin->status == AppTurnitins::STATUS_REVISI_LINK || ($turnitin->status == AppTurnitins::STATUS_PROGRESS && $isAdmin))
            <x-button.black class="mr-2" wire:click="handleForm">Kirim</x-button.black>
        @endif
        <x-button.secondary wire:click="$emit('closeModal')">
            Cancel
        </x-button.secondary>
    </x-modal.footer>
</div>
