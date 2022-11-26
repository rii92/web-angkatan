@props(['title' => 'SOLEN SABER', 'description' => 'Solidaritas Enam Satu Beraksi'])

<div class="mt-16 hero md:pb-80 pb-60 pt-36 lg:h-screen">
    <div class="animate fadeInUp">
        <h1>
            <div class="text-6xl font-bold text-center text-black font-poppins">
                {{ $title }}
            </div>
        </h1>
        <hr class="max-w-lg mx-auto border-2 border-black w-80 md:w-2/4" />
        <p class="px-5 mx-auto text-3xl font-extrabold text-center font-beach-sound text-font-color-sub">
            {{ $description }}
        </p>
    </div>
</div>