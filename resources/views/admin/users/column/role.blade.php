<div class="flex justify-start">
    @if ($user->roles->pluck('name')->contains(AppRoles::ADMIN))
        <x-badge.error text="Admin" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::BPH))
        <x-badge.primary text="BPH" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::AKADEMIK))
        <x-badge.warning text="Akademik" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::HUMAS))
        <x-badge.warning text="Humas" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::USERS))
        <x-badge.success text="Mahasiswa" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::ALUMNI))
        <x-badge.success text="Alumni" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::D3_61))
        <x-badge.success text="D3 61" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::MEMBER))
        <x-badge.secondary text="Pengurus Angkatan" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::KOOR))
        <x-badge.black text="Koordinator" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::EO))
        <x-badge.warning text="EO" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::PUBDOK))
        <x-badge.warning text="Pubdok" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::DANUS))
        <x-badge.warning text="Danus" />
    @endif
</div>
