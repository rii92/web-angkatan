@props(['title', 'description' => '', 'src' => null])
<div class="swiper-slide">
    <img src="{{ $src ? $src : 'https://picsum.photos/400/400?' . $title }}" alt='{{ $title }}' />
    <div class="content">
        <h3 class="text-xl font-poppins font-semibold mb-3">{{ $title }}</h3>
        <p class="mb-5">{{ $description }}</p>
    </div>
</div>
