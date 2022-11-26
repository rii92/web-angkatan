<a {{ $attributes->merge(['href' => '#', 'class' => 'anchor-button bg-purple-button hover:bg-activeButton text-white active:bg-activeButton focus:border-activeButton focus:ring-activeButton']) }}>
    {{ $slot }}
</a>