@props(['width' => 22, 'height' => 22])

<a {{ $attributes->merge(['class' => 'ml-2 text-blue-600 hover:text-blue-800 transition cursor-pointer']) }}>
    <x-icons.clipboard-check width="{{ $width }}" height="{{ $height }}" stroke-width="2.0" />

    {{ $slot }}
</a>
