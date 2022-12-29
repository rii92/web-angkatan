@props(['menu' => 'Menu Item', 'active' => false])

<li @class([
    'bg-blueButton text-font-color-sub' => $active,
    'hover:bg-grayLink hover:text-white' => !$active,
    'relative ml-5 flex items-center transition rounded-tl-md rounded-bl-md my-2',
])>
    <a class="inline-flex items-center w-full px-5 py-3 text-sm font-semibold" {{ $attributes->merge(['href']) }}>
        <div class="flex justify-center w-6">
            {{ $icon }}
        </div>
        <span class="ml-4">{{ $menu }}</span>
    </a>
    @if ($active)
        <span class="absolute inset-y-0 right-0 w-2 bg-darker"></span>
    @endif
</li>
