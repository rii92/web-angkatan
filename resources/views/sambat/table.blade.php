<div>
        <div class="bg-white my-9 p-9 drop-shadow-2xl rounded-2xl">
            <div class="relative mb-8 text-gray-700">
                <input class="w-full h-10 pl-8 pr-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" 
                wire:model="search" 
                type="text" 
                placeholder="Mau cari sambat apa?"/>
                <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                  <x-icons.search></x-icons.search>
                </div>
            </div>
            <div class="flex justify-between mb-8">
                <h2 class="text-2xl font-semibold">Sambat</h2>
                @if (!$is_admin)
                    <button 
                    onclick="Livewire.emit('openModal', 'sambat.create-sambat')" 
                    class="py-1 text-base font-medium text-white duration-300 bg-orange-400 hover:-translate-y-1 hover:scale-105 rounded-xl drop-shadow-2xl px-7"
                    >Buat Sambatan</button>
                @endif
            </div>
            @foreach ($sambat as $s)
                <div 
                class="px-3 py-8 transition duration-300 ease-in-out rounded-md hover:bg-emerald-900 hover:drop-shadow-lg hover:text-white hover:-translate-y-1 hover:scale-105 hover:cursor-pointer"
                onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $s->id]) }})">
                    <div class="grid items-center grid-flow-col grid-cols-4 md:gap-4">
                        <div class="flex flex-col col-span-2">
                            <h3 class="font-semibold">{{ $s->is_anonim ? "Anonim" : $s->users->name}}</h3>
                            <h3 class="mb-2 font-normal">{{ $s->description }}</h3>
                            <p class="font-normal text-yellow-400 mb-7">{{ $s->created_at }}</p>
                        </div>
                        <div>
                            @foreach ($s->tags as $t)
                                <x-badge.secondary text="{{ $t->name }}"></x-badge.secondary>               
                            @endforeach
                        </div>
                        <div class="flex flex-row items-center px-2">
                            <x-icons.thumbs-up-white></x-icons.thumbs-up-white>
                            <?php
                                $upvote = 0;
                                $downvote = 0;
    
                                foreach ($s->sambat_vote as $vote) {
                                    if ($vote->is_upvote == 1) {
                                        $upvote++;
                                    } else {
                                        $downvote++;
                                    }
                                }
                            ?>
                            <p class="ml-1 text-xl font-bold">{{ $upvote - $downvote }}</p>
                        </div>
                        {{-- <div>
                            <button 
                            class="px-6 py-3 mr-0 font-semibold text-white transition duration-300 bg-sky-900 rounded-xl drop-shadow-2xl bg-slate-800 hover:bg-orange-400"
                            onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $s->id]) }})">Lihat</button>
                        </div> --}}
                    </div>
                </div>       
                <hr>
            @endforeach
            <div class="my-4">{{ $sambat->links() }}</div>
        </div>
</div>
