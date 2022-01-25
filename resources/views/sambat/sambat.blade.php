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
    <div class="mx-auto">
        <h1 class="mt-20 mb-6 text-4xl font-bold text-center text-teal-900">Sambat</h1>
        <p class="text-2xl font-normal text-center text-teal-900">Slate helps you see how many more days you need to work</p>
        <p class="mb-20 text-2xl font-normal text-center text-teal-900">to reach your financial goal for the month and year.</p>

        <div class="flex flex-col lg:grid lg:grid-cols-5 gap-4 lg:mb-12 lg:mx-28">
            <div class="relative inline-block w-full text-gray-700">
                <select wire:model="tag_id" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Kategori">
                  <option>Tag</option>
                  @foreach ($tags as $t)
                      <option value="{{ $t->id }}">{{ $t->name }}</option>
                  @endforeach
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
                <input wire:model="search" class="w-full h-10 pl-3 pr-8 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" placeholder="Pencarian"/>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <x-icons.search></x-icons.search>
                </div>
            </div>
            <a href="{{ route('user.sambat.add') }}" class="w-full p-2 text-base font-medium text-center text-white duration-300 bg-sky-900 hover:-translate-y-1 hover:scale-105 rounded-xl drop-shadow-2xl">
                Buat Sambatanmu
            </a>
        </div>
        <div class="w-full md:mx-auto">
            @if ($tag_id)
                @foreach ($tag as $t)
                    @foreach ($t->sambat as $ts)
                        <div class="mx-24 my-7">
                            <div class="flex flex-row mb-2">
                                <div class="mr-1">
                                    <a href="{{ url('sambat/user/'.$ts->user_id) }}"><img class="object-cover w-full rounded-full" src="{{ $ts->users->profile_photo_url }}" alt="{{ $ts->is_anonim ? "Anonim" : $ts->users->name }}" /></a>
                                </div>
                                <div>
                                    <p class="text-base text-gray-500"><a href="{{ url('sambat/user/'.$ts->user_id) }}" class="mr-2">{{ $ts->is_anonim ? "Anonim" : $ts->users->name }}</a><span class="mr-2">• Kelas </span><span class="mr-2">• {{ $ts->created_at }}</span></p>
                                    <div class="flex flex-row flex-wrap items-center m-2">
                                        @foreach ($ts->tags as $tst)
                                            <a href="{{ url('sambat/tag/'.$tst->id) }}" class="p-2 bg-gray-200 rounded-xl hover:bg-gray-300 m-1">{{ $tst->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="px-10 py-8 rounded-lg bg-amber-200">
                                <p class="mb-1">{!! Str::markdown($ts->description) !!}</p>
                                <button 
                                onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $ts->id]) }})"
                                class="inline-block px-6 py-3 mr-0 font-semibold text-right text-white transition duration-300 bg-sky-900 rounded-xl drop-shadow-2xl bg-slate-800 hover:bg-orange-400">Lihat</button>
                            </div>
                        </div>                             
                    @endforeach         
                @endforeach
            @elseif ($user_id)
                @foreach ($user as $u)          
                    @foreach ( $u->sambat as $us )
                        <div class="mx-24 my-7">
                            <div class="flex flex-row mb-2">
                                <div class="mr-1">
                                    <a href="{{ url('sambat/user/'.$u->id) }}"><img class="object-cover w-full rounded-full" src="{{ $u->profile_photo_url }}" alt="{{ $us->is_anonim ? "Anonim" : $u->name }}" /></a>
                                </div>
                                <div>
                                    <p class="text-base text-gray-500"><a href="{{ url('sambat/user/'.$u->id) }}" class="mr-2">{{ $us->is_anonim ? "Anonim" : $u->name }}</a><span class="mr-2">• Kelas </span><span class="mr-2">• {{ $us->created_at }}</span></p>
                                    <div class="mt-1">
                                        @foreach ($us->tags as $t)
                                            <a href="{{ url('sambat/tag/'.$t->id) }}" class="p-2 bg-gray-200 rounded-xl hover:bg-gray-300 m-1">{{ $t->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="px-10 py-8 rounded-lg bg-amber-200">
                                <p class="mb-1">{!! Str::markdown($us->description) !!}</p>
                                <button 
                                onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $us->id]) }})"
                                class="inline-block px-6 py-3 mr-0 font-semibold text-right text-white transition duration-300 bg-sky-900 rounded-xl drop-shadow-2xl bg-slate-800 hover:bg-orange-400">Lihat</button>
                            </div>
                        </div>          
                    @endforeach
                @endforeach
                @else
                    @foreach ( $sambat as $s )
                        <div class="mx-24 my-7">
                            <div class="flex flex-row mb-2">
                                <div class="mr-1">
                                    <a href="{{ url('sambat/user/'.$s->user_id) }}"><img class="object-cover w-full rounded-full" src="{{ $s->users->profile_photo_url }}" alt="{{ $s->is_anonim ? "Anonim" : $s->users->name }}" /></a>
                                </div>
                                <div>
                                    <p class="text-base text-gray-500"><a href="{{ url('sambat/user/'.$s->user_id) }}" class="mr-2">{{ $s->is_anonim ? "Anonim" : $s->users->name }}</a><span class="mr-2">• Kelas </span><span class="mr-2">• {{ $s->created_at }}</span></p>
                                    <div class="mt-1">
                                        @foreach ($s->tags as $t)
                                            <a href="{{ url('sambat/tag/'.$t->id) }}" class="p-2 bg-gray-200 rounded-xl hover:bg-gray-300 m-1">{{ $t->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="px-10 py-8 rounded-lg bg-amber-200">
                                <p class="mb-1">{!! Str::markdown($s->description) !!}</p>
                                <button 
                                onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $s->id]) }})"
                                class="inline-block px-6 py-3 mr-0 font-semibold text-right text-white transition duration-300 bg-sky-900 rounded-xl drop-shadow-2xl bg-slate-800 hover:bg-orange-400">Lihat</button>
                            </div>
                        </div>        
                    @endforeach
                    <div class="m-10">{{$sambat->links()}} </div>
            @endif     
        </div>
    </div>
</body>

@livewireScripts
<script src="{{ mix('js/livewire-handler.js') }}"></script>
@stack('scripts')

</html>

