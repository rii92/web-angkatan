@props(['menu' => 'Menu Item', 'active' => false])

<li @class([
    'bg-lighter text-white' => $active,
    'hover:bg-gray-200 hover:text-gray-800' => !$active,
    'relative ml-5 flex items-center transition rounded-tl-md rounded-bl-md my-2',
])>
    <a class="inline-flex items-center w-full px-5 py-3 text-sm font-semibold" {{ $attributes->merge(['href']) }}>
        <div class="w-6 flex justify-center">
            {{ $icon }}
        </div>
        <span class="ml-4">{{ $menu }}</span>
    </a>
    @if ($active)
        <span class="absolute inset-y-0 right-0 w-2 bg-darker"></span>
    @endif
</li>
