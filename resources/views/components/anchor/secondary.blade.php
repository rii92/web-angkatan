<a
    {{ $attributes->merge(['href' => '#', 'class' => 'bg-gray-200 hover:bg-gray-300 text-gray-600 active:bg-gray-300 focus:border-gray-500 focus:ring-gray-300 anchor-button']) }}>
    {{ $slot }}
</a>
