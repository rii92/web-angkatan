<div class="flex justify-center">
    @if ($start_time > now())
        <x-badge.warning text="Not Started" />
    @elseif ($end_time < now())
        <x-badge.success text="Finished" />
    @else
        <x-badge.primary text="Ongoing" />
    @endif
</div>
