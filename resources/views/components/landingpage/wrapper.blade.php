@props(['title'])

<div class="min-h-screen py-6 bg-light-4 bg-gradient-to-t from-light-4 to-white">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="py-10">
            <div class="text-4xl font-bold text-center font-poppins text-main">
                {{ $title }}
            </div>
            <div class="mb-2 text-xl text-center text-orange-500 font-holiday-free">
                Kabinet Enam Puluh Berkembang
            </div>
        </h1>
        {{ $slot }}
    </div>
</div>
