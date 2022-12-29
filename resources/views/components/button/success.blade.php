<button
    {{ $attributes->merge([
    'type' => 'button',
    'class' => 'bg-purple-button hover:bg-font-color-sub text-white active:bg-green-400 focus:border-green-400 focus:ring-green-300 anchor-button',
]) }}>
    {{ $slot }}
</button>
