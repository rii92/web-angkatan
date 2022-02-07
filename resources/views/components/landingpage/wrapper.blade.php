@props(['title'])

<div class="py-6 bg-light-4 bg-gradient-to-t from-light-4 to-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="py-10">
            <div class="font-poppins font-bold text-4xl text-center text-main">
                {{ $title }}
            </div>
            <div class="font-holiday-free text-xl text-center mb-2 text-orange-500">
                Kabinet Enam Puluh Berkembang
            </div>
        </h1>
        {{ $slot }}
    </div>
</div>
