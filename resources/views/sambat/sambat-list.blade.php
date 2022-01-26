<div>
    <div class="mx-auto">
        <h1 class="mt-20 mb-6 text-4xl font-bold text-center text-teal-900">Sambat</h1>
        <p class="text-2xl font-normal text-center text-teal-900">Slate helps you see how many more days you need to work</p>
        <p class="mb-20 text-2xl font-normal text-center text-teal-900">to reach your financial goal for the month and year.</p>

        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4 lg:mb-12 lg:mx-28">
            
            <div class="relative col-span-2 text-gray-700">
                <input wire:model.debounce.1000ms="search" type="text" class="w-full h-10 pl-3 pr-8 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" placeholder="Pencarian"/>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <x-icons.search></x-icons.search>
                </div>
            </div>
            <a href="{{ route('user.sambat.add') }}" class="w-full p-2 text-base font-medium text-center text-white duration-300 bg-sky-900 hover:-translate-y-1 hover:scale-105 rounded-xl drop-shadow-2xl">
                Buat Sambatanmu
            </a>
        </div>
        <div class="w-full md:mx-auto">
                    @forelse ( $sambat as $s )
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
                    @empty
                        <h1 class="text-center">Sambatan yang kemu cari ngga ada nih...</h1>     
                    @endforelse
                    <div class="m-10">{{$sambat->links()}} </div>    
        </div>
    </div>
</div>

