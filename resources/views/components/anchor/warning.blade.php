<a
    {{ $attributes->merge(['href' => '#', 'class' => 'bg-yellow-400 hover:bg-yellow-300 text-white active:bg-yellow-300 focus:border-yellow-300 focus:ring-yellow-300 anchor-button']) }}>
    {{ $slot }}
</a>
