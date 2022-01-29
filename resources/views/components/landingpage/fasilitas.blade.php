@props(['title', 'href' => '#'])

<div data-aos="fade-up" data-aos-duration="1000" class="border border-gray-300 rounded-md p-10 text-center">
    <div class="flex justify-center mb-6">
        {{ $icon }}
    </div>
    <h3 class="mb-6 font-bold font-poppins text-2xl">{{ $title }}</h3>
    <p class="text-lg mb-6">
        {{ $description }}
    </p>
    <div class="flex justify-center">
        <x-anchor.primary href="{{ $href }}" class="button-medium">Selengkapnya
        </x-anchor.primary>
    </div>
</div>
