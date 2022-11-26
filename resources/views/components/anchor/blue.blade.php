<a {{ $attributes->merge(['href' => '#', 'class' => 'anchor-button bg-blueButton hover:bg-activeButton hover:text-white text-black active:bg-activeButton focus:border-activeButton focus:ring-activeButton']) }}>
    {{ $slot }}
</a>