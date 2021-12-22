<div class="flex justify-center">
    @switch($status)
        @case(AppMeetings::PRESENT)
            <x-badge.success text="Hadir" />
        @break
        @case(AppMeetings::HAS_PERMISSION)
            <x-badge.primary text="Izin" />
        @break
        @default
            <x-badge.error text="Tidak Hadir" />
    @endswitch
</div>
