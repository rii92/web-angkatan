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
                    <a 
                    href="{{ route('user.sambat.add') }}"
                    class="py-1 text-base font-medium text-white duration-300 bg-orange-400 hover:-translate-y-1 hover:scale-105 rounded-xl drop-shadow-2xl px-7"
                    >Buat Sambatan</a>
                @endif
            </div>
            @foreach ($sambat as $s)
                <div 
                class="px-3 py-8 transition duration-300 ease-in-out rounded-md hover:bg-emerald-900 hover:drop-shadow-lg hover:text-white hover:-translate-y-1 hover:scale-105 ">
                    <div class="grid items-center grid-flow-col grid-cols-4 md:gap-4">
                        <div class="col-span-3 grid items-center grid-flow-col grid-cols-4 md:gap-4 hover:cursor-pointer"
                        onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $s->id]) }})">
                        <img class="object-cover w-full rounded-full mr-2" src="{{ $s->users->profile_photo_url }}" alt="{{$s->users->name }}" /></a>
                            <div class="flex flex-col col-span-2">
                                <h3 class="font-semibold">{{$s->users->name}}</h3>
                                <h3 class="prose mb-2 font-normal">{!! Str::markdown($s->description) !!}</h3>
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
                        </div>
                        <div class="flex flex-col md:flex-row col-span-2">
                            @if ($s->user_id == Auth::user()->id)
                                <x-anchor.success class="mb:2 md:ml-2" href="{{ route('user.sambat.edit', $s) }}">
                                    Edit
                                </x-anchor.success>
                            @endif
                            @if ($s->user_id == Auth::user()->id || AppRoles::ADMIN)
                                <x-button.error class="mb:2 md:ml-2"
                                    onclick="Livewire.emit('openModal', 'sambat.modal-delete', {{ json_encode(['sambat_id' => $s->id]) }})"
                                    ><span>Delete</span>
                                </x-button.error>
                            @endif
                        </div>
                    </div>
                </div>       
                <hr>
            @endforeach
            <div class="my-4">{{ $sambat->links() }}</div>
        </div>
</div>
