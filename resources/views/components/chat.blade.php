<div>
@php
    $position = ($position=='start')?['start','']:['end','bg-gray-100']
@endphp
<li class="flex justify-{{ $position[0] }} mt-1">
    <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow {{ $position[1] }}">
        {{ $slot }}
    </div>
</li>
</div>
