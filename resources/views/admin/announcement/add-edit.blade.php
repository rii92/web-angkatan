<x-dashboard-layout title="Announcement">
    <x-card.base title="{{ $title }}">
        @livewire('admin.announcement.form', ['announcement_id' => $id ?? null])
    </x-card.base>
</x-dashboard-layout>
