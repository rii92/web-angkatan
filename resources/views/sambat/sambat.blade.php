<!DOCTYPE html>
<html lang="en" x-data="initData()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title and descriptioan --}}
    <title>{{ ucfirst('sambat') }} | {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/img/logo_angkatan.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('styles')
</head>

<body>
    <div>
        <h1 class="mt-20 mb-6 text-4xl font-bold text-center text-teal-900">Sambat</h1>
        <p class="text-2xl font-normal text-center text-teal-900">Slate helps you see how many more days you need to work</p>
        <p class="mb-20 text-2xl font-normal text-center text-teal-900">to reach your financial goal for the month and year.</p>

        <div class="grid grid-cols-5 gap-4 mb-12 mx-28">
            <div class="relative inline-block w-full text-gray-700">
                <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Kategori">
                  <option>Kategori</option>
                  <option>Another option</option>
                  <option>And one more</option>
                </select>
            </div>
            <div class="relative inline-block w-full text-gray-700">
                <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Urutkan">
                  <option>Urutkan</option>
                  <option>Another option</option>
                  <option>And one more</option>
                </select>
            </div>
            <div class="relative col-span-2 text-gray-700">
                <input class="w-full h-10 pl-3 pr-8 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" placeholder="Pencarian"/>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                </div>
            </div>
            <button class="py-1 text-base font-medium text-white duration-300 bg-sky-900 hover:-translate-y-1 hover:scale-105 rounded-xl drop-shadow-2xl px-7">
                Buat Sambatanmu
            </button>
        </div>

        <div class="mx-28">
            @for ($i = 0; $i < 4; $i++)
                <div class="mx-24 my-7">
                    <div>
                        <div>
                            <img src="" alt="">
                        </div>
                        <div>
                            <h2 class="text-3xl font-semibold">Judul Sambat</h2>
                            <p class="text-base text-gray-500"><span class="mr-2">Nama Lengkap </span><span class="mr-2">• Kelas </span><span class="mr-2">• Tanggal</span></p>
                        </div>
                    </div>
                    <div class="px-10 py-8 rounded-lg bg-amber-200">
                        <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolores cumque ea, corporis maiores ad natus magni accusantium repellat quidem ipsa illo rem voluptatem magnam modi et vero ipsum praesentium dicta quos eum sequi sunt tempore. Sint illum harum neque quod modi delectus eos possimus, corrupti odit eaque, officiis libero!</p>
                        <button class="inline-block px-6 py-3 mr-0 font-semibold text-right text-white transition duration-300 bg-sky-900 rounded-xl drop-shadow-2xl bg-slate-800 hover:bg-orange-400">Lihat</button>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</body>

@livewireScripts
<script src="{{ mix('js/livewire-handler.js') }}"></script>
@stack('scripts')

</html>

