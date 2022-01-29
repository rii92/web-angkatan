@props(['status'])

@if ($status == AppKonsul::STATUS_WAIT)
    <x-badge.warning text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
@elseif ($status == AppKonsul::STATUS_REJECT)
    <x-badge.error text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
@elseif ($status == AppKonsul::STATUS_PROGRESS)
    <x-badge.primary text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
@elseif ($status == AppKonsul::STATUS_DONE)
    <x-badge.success text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
@endif
