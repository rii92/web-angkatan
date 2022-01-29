@props(['color' => 'white', 'title'])


<div {{ $attributes->merge(['class' => 'px-4 py-3 bg-white']) }}>
    <h1 class="text-sm font-medium text-gray-500">
        {{ $title }}
    </h1>
    <p class="mt-1 text-sm text-gray-900">
        {{ $slot }}
    </p>
</div>
