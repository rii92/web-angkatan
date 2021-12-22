<div class="flex justify-center">
    @if ($role == AppRoles::ADMIN)
        <x-badge.error text="Admin" />
    @endif
    @if ($role == AppRoles::BPH)
        <x-badge.primary text="BPH" />
    @endif
    @if ($role == AppRoles::AKADEMIK)
        <x-badge.black text="Akademik" />
    @endif
    @if ($role == AppRoles::HUMAS)
        <x-badge.warning text="Humas" />
    @endif
    @if ($role == AppRoles::USERS)
        <x-badge.success text="Mahasiswa" />
    @endif
    @if ($role == AppRoles::MEMBER)
        <x-badge.secondary text="Pengurus Akademik" />
    @endif
</div>
