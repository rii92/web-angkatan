<div class="flex justify-center">
    @if ($user->roles->pluck('name')->contains(AppRoles::ADMIN))
        <x-badge.error text="Admin" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::BPH))
        <x-badge.primary text="BPH" />
    @endif
    @if ($user->roles->pluck('name')->contains(AppRoles::AKADEMIK))
        <x-badge.black text="Akademik" />
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
</div>
