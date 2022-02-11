@props(['width' => 22, 'height' => 22])

<a {{ $attributes->merge(['class' => 'ml-2 text-red-600 hover:text-red-800 transition cursor-pointer']) }}>
    <x-icons.delete width="{{ $width }}" height="{{ $height }}" stroke-width="2.0" />

    {{ $slot }}
</a>
