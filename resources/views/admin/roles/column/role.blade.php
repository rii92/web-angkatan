<div class="flex justify-center">
    @if ($role == AppRoles::ADMIN)
        <x-badge.error text="Admin" />
    @endif
    @if ($role == AppRoles::BPH)
        <x-badge.primary text="BPH" />
    @endif
    @if ($role == AppRoles::AKADEMIK)
        <x-badge.warning text="Akademik" />
    @endif
    @if ($role == AppRoles::HUMAS)
        <x-badge.warning text="Humas" />
    @endif
    @if ($role == AppRoles::USERS)
        <x-badge.success text="Mahasiswa" />
    @endif
    @if ($role == AppRoles::ALUMNI)
        <x-badge.success text="Alumni" />
    @endif
    @if ($role == AppRoles::D3_61)
        <x-badge.success text="D3 61" />
    @endif
    @if ($role == AppRoles::MEMBER)
        <x-badge.secondary text="Pengurus Angkatan" />
    @endif
    @if ($role == AppRoles::KOOR)
        <x-badge.black text="Koordinator" />
    @endif
    @if ($role == AppRoles::EO)
        <x-badge.warning text="EO" />
    @endif
    @if ($role == AppRoles::PUBDOK)
        <x-badge.warning text="Pubdok" />
    @endif
    @if ($role == AppRoles::DANUS)
        <x-badge.warning text="Danus" />
    @endif
</div>
