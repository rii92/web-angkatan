<div>
    <x-modal.header title="Sambat" bordered />
    <x-modal.body>
        <div class="overflow-hidden rounded-lg shadow-lg mb-4">
            <div class="px-6 py-4">
                <div class="flex flex-row justify-between mb-4">
                    <div>
                        <h4 class="text-xl font-semibold tracking-tight text-gray-800">{{ $sambat->is_anonim == 1 ? "Anonim" : $sambat->users->name }}</h4>
                        <p class="font-normal text-yellow-400">{{ $sambat->created_at }}</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <button id="is_upvote"><x-icons.thumbs-up-white></x-icons.thumbs-up-white></button>
                        <?php
                                $upvote = 0;
                                $downvote = 0;
    
                                foreach ($sambat->sambat_vote as $vote) {
                                    if ($vote->is_upvote == 1) {
                                        $upvote++;
                                    } else {
                                        $downvote++;
                                    }
                                }
                            ?>
                            <p class="ml-1 text-xl font-bold">{{ $upvote - $downvote }}</p>
                        <button id="is_downvote"><x-icons.thumbs-down-white></x-icons.thumbs-down-white></button>
                    </div>
                </div>
                <p class="leading-normal text-gray-700 font-normal text-base mb-4">{!! $sambat->description !!}</p>

                @foreach ($sambat->tags as $t)
                    <x-badge.secondary text="{{ $t->name }}"></x-badge.secondary>               
                @endforeach
            </div>
        </div>

        <h2 class="mb-2">Komentar</h2>
        @foreach ($sambat_comment as $sc)
        <div class="flex flex-row justify-between p-4">
            <div>
                <h2 class="font-semibold">{{ $sc->name }}</h2>
                <p class="font-normal text-yellow-400 mb-4">{{ $sc->created_at }}</p>
                <p>{{ $sc->description }}</p>
            </div>
            @if ($sc->user_id == Auth::user()->id)
                <div>
                    <x-button.error onclick="Livewire.emit('delete', {{ $sc->id }});"><x-icons.trash></x-icons.trash></x-button.error>
                </div>
            @endif    
        </div>
            <hr>
        @endforeach

        <div class="mb-2">
            {{ $sambat_comment->links() }}
        </div>

        <div class="relative text-gray-700">
            <input class="w-full h-10 pl-3 pr-8 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" placeholder="Apa komentarmu?" id="description"/>
            <button onclick="Livewire.emit('submitComment', document.getElementById('description').value);" type="submit" class="transition duration-300 absolute inset-y-0 right-0 flex items-center px-4 font-bold text-white bg-indigo-600 rounded-r-lg hover:bg-indigo-500 focus:bg-indigo-700">Komentar</button>
        </div>

    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">
            Tutup
        </x-button.secondary>
    </x-modal.footer>
</div>
