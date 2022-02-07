@props(['konsulId'])

<x-icons.annotation stroke-width="2.0" width="22" height="22" onclick="Livewire.emit('openModal', 'activity.konsultasi' ,
    {{ json_encode(['konsul_id' => $konsulId]) }})"
    {{ $attributes->merge(['class' => 'text-blue-600 cursor-pointer inline-block']) }} />
