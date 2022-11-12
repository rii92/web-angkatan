<x-dashboard-layout title="Daftar Formasi Satker">
    <x-card.base title="Satuan Kerja">
        @slot('aside')
            <div class="flex items-center">
                <x-button.success onclick="Livewire.emit('openModal', 'admin.simulasi.satker.modal-add-edit')">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 text-xs hidden lg:block">Satker</span>
                </x-button.success>
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-button.secondary class="ml-1">
                            <x-icons.arrow-down stroke-width="2.5" width="16" height="16" />
                        </x-button.secondary>
                    </x-slot>

                    <x-slot name="content">
                        <x-button.dropdown-item>
                            Download Format
                        </x-button.dropdown-item>
                        <x-button.dropdown-item>
                            Import Excel
                        </x-button.dropdown-item>


                    </x-slot>
                </x-jet-dropdown>

            </div>
        @endslot
        @livewire('admin.simulasi.satker.table')
    </x-card.base>
</x-dashboard-layout>
