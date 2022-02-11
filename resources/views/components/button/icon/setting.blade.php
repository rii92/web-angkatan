@props(['width' => 22, 'height' => 22])

<a {{ $attributes->merge(['class' => 'ml-2 text-gray-600 hover:text-gray-800 transition cursor-pointer']) }}>
    <x-icons.settings width="{{ $width }}" height="{{ $height }}" stroke-width="2.0" />

    {{ $slot }}
</a>
