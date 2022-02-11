@props(['width' => 22, 'height' => 22])

<a {{ $attributes->merge(['class' => 'ml-2 text-orange-600 hover:text-orange-800 transition cursor-pointer']) }}>
    <x-icons.chat width="{{ $width }}" height="{{ $height }}" stroke-width="2.0" />

    {{ $slot }}
</a>
