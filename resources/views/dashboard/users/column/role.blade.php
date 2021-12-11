<div class="flex justify-center">
    @if ($user->hasRole('admin'))
        <x-badge.primary text="admin"/>
    @else
        <x-badge.success text="users"/>
    @endif
</div>