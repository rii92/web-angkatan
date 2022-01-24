<div class="flex justify-center">
    @if ($konsul->status == 'done')
        <x-badge.primary text="{{ $konsul->status }}" />
    @else
        <x-badge.success text="{{ $konsul->status }}" />
    @endif
    @if ($konsul->is_publish)
        <x-badge.warning text="Private" />
    @else
        <x-badge.error text="Publish" />
    @endif
</div>
