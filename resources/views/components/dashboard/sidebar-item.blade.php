@props(['menu' => 'Menu Item', 'active' => false])

<li @class([
    'bg-white text-black' => $active,
    'hover:bg-activeButton hover:text-white' => !$active,
    'relative ml-5 flex items-center transition rounded-tl-md rounded-bl-md my-2 text-white',
])>
    <a class="inline-flex items-center w-full px-5 py-3 text-sm font-semibold" {{ $attributes->merge(['href']) }}>
        <div class="flex justify-center w-6">
            {{ $icon }}
        </div>
        <span class="ml-4">{{ $menu }}</span>
    </a>
    @if ($active)
        <span class="absolute inset-y-0 right-0 w-2 bg-activeButton"></span>
    @endif
</li>
