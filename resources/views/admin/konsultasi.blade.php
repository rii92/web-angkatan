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

        @switch($type['type'])
            @case(1) @livewire('konsultasi.form',
                ['konsul_id'=>$konsul->id])
            @break
            @case(2) @livewire('konsultasi.form',
                ['catagory'=>$catagory])
            @break
            @case(3) @livewire('konsultasi.table', ['is_admin' =>
                1,'catagory'=>$catagory])
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
