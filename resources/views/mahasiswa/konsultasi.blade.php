@php
if (!isset($catagory)) {
    $type = ['title' => 'Chat Konsultasi | ' . $konsul->title, 'type' => 1];
} elseif (isset($create)) {
    $type = ['title' => 'Buat Konsultasi ' . ucwords($catagory), 'type' => 2];
} else {
    $type = ['title' => 'Konsultasi ' . ucwords($catagory), 'type' => 3];
}
@endphp

<x-dashboard-layout title="{{ $type['title'] }}">
    <x-card.base>
        @slot('aside')
            <div class="flex items-center">
                <x-anchor.success href="{{ route('user.konsultasi.create', $catagory) }}">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2">Konsultasi {{ ucwords($catagory) }}</span>
                </x-anchor.success>
            </div>
        @endslot

        @switch($type['type'])
            @case(1) @livewire('konsultasi.form',
                ['konsul_id'=>$konsul->id])
            @break
            @case(2) @livewire('konsultasi.form',
                ['catagory'=>$catagory])
            @break
            @case(3) @livewire('konsultasi.table', ['is_admin' =>
                0,'catagory'=>$catagory])
            @break
        @endswitch

        @if (session('message'))
            @push('scripts')
                <script>
                    Livewire.emit('success', "{{ session('message') }}")
                </script>
            @endpush
        @endif
    </x-card.base>
</x-dashboard-layout>
