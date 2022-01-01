@props(['width' => '9', 'height' => '9'])

<img src="/img/logo_angkatan.png" alt="Logo Angkatan "
    {{ $attributes->merge(['class' => "w-{$width} h-{$height}"]) }}>
