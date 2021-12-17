@props(['bordered' => false])

@if ($bordered)
<div class="border-t border-gray-200" />
@endif

<div class="flex justify-center md:justify-end items-center px-5 my-3 text-gray-700">
    {{ $slot }}
</div>
