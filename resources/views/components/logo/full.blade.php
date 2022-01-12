<div {{ $attributes->merge(['class' => 'font-bold md:text-xl text-lg text-gray-700']) }}>
    <a class="flex items-center" href="{{ route('home') }}">
        <x-logo.image class="mr-3" width="9" height="9" />
        <x-logo.text />
    </a>
</div>
