@props(['role'])

@if ($role == "admin")
<x-badge.primary text="admin" />
@else
<x-badge.success text="users" />
@endif
