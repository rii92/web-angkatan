<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' =>
            'block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition',
    ]) }}>
    {{ $slot }}
</button>
