@props(['status'])

@switch($status)
    @case(AppKonsul::STATUS_WAIT)
        <x-badge.warning text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
    @break
    @case(AppKonsul::STATUS_REJECT)
        <x-badge.error text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
    @break
    @case(AppKonsul::STATUS_PROGRESS)
        <x-badge.primary text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
    @break
    @case(AppKonsul::STATUS_DONE)
        <x-badge.success text="{{ $status }}" {{ $attributes->merge(['class' => 'capitalize']) }} />
    @break
@endswitch
