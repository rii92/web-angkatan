@props(['title'])

<div class="min-h-screen py-6 mt-16 hero">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="py-10">
            <div class="text-6xl font-bold text-center text-black font-poppins">
                {{ $title }}
            </div>
            <hr class="max-w-lg mx-auto border-2 border-black w-60 md:w-2/4" />
            <div class="mb-2 text-3xl font-extrabold text-center text-font-color-sub font-beach-sound">
                Polstat STIS Angkatan 61
            </div>
        </h1>
        {{ $slot }}
    </div>
</div>
