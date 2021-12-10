<button
    {{ $attributes->merge([
    'type' => 'button',
    'class' => 'bg-indigo-500 hover:bg-indigo-400 text-white active:bg-indigo-400 focus:border-indigo-400 focus:ring-indigo-300 anchor-button',
]) }}>
    {{ $slot }}
</button>
