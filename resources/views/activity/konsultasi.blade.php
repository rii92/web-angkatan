<div>
    <x-modal.header title="Riwayat Konsultasi" bordered />
    <x-modal.body>

        <div style="max-height: 60vh" class="overflow-y-auto">
            @forelse ($konsul->activity as $userActivity)
                <x-activity.wrapper>
                    <x-activity.list :activity="$userActivity" />

                </x-activity.wrapper>
            @empty
                <p class="italic text-center text-gray-600">Belum ada aktivitas</p>
            @endforelse
        </div>

    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.secondary wire:click="$emit('closeModal')">
            Cancel
        </x-button.secondary>
    </x-modal.footer>
</div>
