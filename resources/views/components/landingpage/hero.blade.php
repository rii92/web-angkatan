@props(['title' => 'KEMBANG', 'subtitle' => 'Kabinet Enam Puluh Berkembang', 'description' => 'Mengabdi, Penuh Dedikasi, Integritas, Tanpa Batas'])

<div class="hero md:pb-80 pb-60 pt-36 lg:h-screen">
    <div class="animate fadeInUp">
        <h1>
            <div class="font-poppins font-bold text-6xl lg:text-8xl md:text-7xl text-center text-main">
                {{ $title }}
            </div>
            <div class="font-holiday-free text-xl lg:text-4xl md:text-3xl text-center mb-2 text-orange-500">
                {{ $subtitle }}
            </div>
        </h1>
        <hr class="border-main border-2 max-w-lg w-80 md:w-2/4 mx-auto" />
        <p class="font-archivo-narrow font-semibold text-main text-center md:text-xl xl:w-7/12 lg:w-8/12 md:w-10/12 max-w-7xl px-5 mx-auto">
            {{ $description }}
        </p>
    </div>
</div>