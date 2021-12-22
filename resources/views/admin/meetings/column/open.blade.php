<div class="flex justify-center">
    @if ($is_open)
        <x-badge.success text="Open" />
    @else
        <x-badge.error text="Closed" />
    @endif
</div>
