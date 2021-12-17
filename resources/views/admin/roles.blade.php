<x-dashboard-layout title="Role dan Permission">
    <div class="grid md:grid-cols-7 grid-cols-1">
        <div class="md:col-span-3">
            <x-card.base>
                @livewire('admin.roles.table-roles')
            </x-card.base>
        </div>

        <div class="md:col-span-4">
            <x-card.base>
                @livewire('admin.roles.table-permission')
            </x-card.base>
        </div>
    </div>
</x-dashboard-layout>
