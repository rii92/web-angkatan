<a
    {{ $attributes->merge(['href' => '#', 'class' => 'bg-green-500 hover:bg-green-400 text-white active:bg-green-400 focus:border-green-400 focus:ring-green-300 anchor-button']) }}>
    {{ $slot }}
</a>
