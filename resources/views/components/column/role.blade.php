@props(['role'])

@if ($role == ROLE_ADMIN)
<x-badge.primary text="Admin" />
@elseif ($role == ROLE_BPH)
<x-badge.success text="BPH" />
@elseif ($role == ROLE_HUMAS)
<x-badge.error text="Humas" />
@elseif ($role == ROLE_AKADEMIK)
<x-badge.warning text="Akademik" />
@else
<x-badge.secondary text="Mahasiswa" />
@endif
