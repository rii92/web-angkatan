@props(['title' => 'SOLEN SABER', 'subtitle' => 'Kabinet Enam Puluh Berkembang', 'description' => 'Solidaritas Enam Satu Beraksi'])

<div class="hero md:pb-80 pb-60 pt-36 lg:h-screen">
    <div class="animate fadeInUp">
        <h1>
            <div class="text-6xl font-bold text-center font-poppins lg:text-8xl md:text-7xl text-main">
                {{ $title }}
            </div>
            <div class="mb-2 text-xl text-center text-orange-500 font-holiday-free lg:text-4xl md:text-3xl">
                {{ $subtitle }}
            </div>
        </h1>
        <hr class="max-w-lg mx-auto border-2 border-main w-80 md:w-2/4" />
        <p class="px-5 mx-auto font-semibold text-center font-archivo-narrow text-main md:text-xl xl:w-7/12 lg:w-8/12 md:w-10/12 max-w-7xl">
            {{ $description }}
        </p>
    </div>
</div>