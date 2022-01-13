<x-dashboard-layout title="Info Skripsi">
  <x-card.base title="Isi datanya dulu ya">
    @slot('aside')
    @hasanyrole(AppRoles::USERS . '|' . AppRoles::D3_61)
    <div class="flex items-center">
      <x-button.success onclick="Livewire.emit('openModal', 'skripsi.modal-update')">
        <x-icons.plus stroke-width="2.5" width="16" height="16" />
        <span class="ml-2">Update My Skripsi</span>
      </x-button.success>
    </div>
    @endhasanyrole
    @endslot
    @livewire('skripsi.table')
  </x-card.base>
</x-dashboard-layout>