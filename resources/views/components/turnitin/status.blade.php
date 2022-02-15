<div class="{{ isset($display) ? $display : 'flex justify-center' }}">
    @switch($status)
        @case(AppTurnitins::STATUS_WAIT)
            <x-badge.warning text="{{ $status }}" class='capitalize' />
        @break
        @case(AppTurnitins::STATUS_REJECT)
            <x-badge.error text="{{ $status }}" class='capitalize' />
        @break
        @case(AppTurnitins::STATUS_REVISI_LINK)
            <x-badge.secondary text="{{ $status }}" class='capitalize' />
        @break
        @case(AppTurnitins::STATUS_PROGRESS)
            <x-badge.primary text="{{ $status }}" class='capitalize' />
        @break
        @case(AppTurnitins::STATUS_DONE)
            <x-badge.success text="{{ $status }}" class='capitalize' />
        @break
    @endswitch
</div>
