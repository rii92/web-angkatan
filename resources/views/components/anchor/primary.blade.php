<a {{ $attributes->merge(['href' => '#', 'class' => 'anchor-button bg-main hover:bg-orange-500 text-white active:bg-orange-500 focus:border-orange-500 focus:ring-orange-400']) }}>
    {{ $slot }}
</a>