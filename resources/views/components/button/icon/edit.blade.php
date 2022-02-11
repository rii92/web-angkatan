@props(['width' => 22, 'height' => 22])

<a {{ $attributes->merge(['class' => 'ml-2 text-green-600 hover:text-green-800 transition cursor-pointer']) }}>
    <x-icons.pencil-alt width="{{ $width }}" height="{{ $height }}" stroke-width="2.0" />

    {{ $slot }}
</a>
