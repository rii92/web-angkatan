<div class="inline">
    @switch($status)
        @case(AppKonsul::STATUS_WAIT)
            <x-badge.warning text="{{ $status }}" class='capitalize' />
        @break
        @case(AppKonsul::STATUS_REJECT)
            <x-badge.error text="{{ $status }}" class='capitalize' />
        @break
        @case(AppKonsul::STATUS_PROGRESS)
            <x-badge.primary text="{{ $status }}" class='capitalize' />
        @break
        @case(AppKonsul::STATUS_DONE)
            <x-badge.success text="{{ $status }}" class='capitalize' />
        @break
    @endswitch
</div>
