<div>
    <x-modal.header title="Detail Skripsi" bordered />
    <x-modal.body class="mx-0">
        <x-description-list title="Nama" class="bg-gray-50">
            {{ $user_details->user->name }} ({{ $user_details->nim }})
        </x-description-list>
        <x-description-list title="Kelas">
            {{ $user_details->kelas }}
        </x-description-list>
        <x-description-list title="Dosen Pembimbing" class="bg-gray-50">
            {{ $user_details->skripsi_dosbing }}
        </x-description-list>
        <x-description-list title="Judul">
            {{ $user_details->skripsi_judul }}
        </x-description-list>
        <x-description-list title="Metode Penelitian" class="bg-gray-50">
            {{ $user_details->skripsi_metode }}
        </x-description-list>
        <x-description-list title="Variabel Dependen">
            <div class="whitespace-pre-wrap">{{ $user_details->skripsi_variabel_dependent }}</div>
        </x-description-list>
        <x-description-list title="Variabel Independen" class="bg-gray-50">
            <div class="whitespace-pre-wrap">{{ $user_details->skripsi_variabel_independent }}</div>
        </x-description-list>
    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</div>
