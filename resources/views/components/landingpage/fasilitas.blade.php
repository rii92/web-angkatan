@props(['title', 'href' => '#'])

{{-- <div data-aos="fade-up" data-aos-duration="1000" class="p-10 text-center border border-gray-300 rounded-md"> --}}
<div class="p-10 text-center border border-gray-300 rounded-md">
    <div class="flex justify-center mb-6">
        {{ $icon }}
    </div>
    <h3 class="mb-6 text-2xl font-bold font-poppins">{{ $title }}</h3>
    <p class="mb-6 text-lg">
        {{ $description }}
    </p>
    <div class="flex justify-center">
        <x-anchor.blue href="{{ $href }}" class="px-8 py-3 text-sm font-extrabold font-beach-sound">Selengkapnya
        </x-anchor.blue>
    </div>
</div>
