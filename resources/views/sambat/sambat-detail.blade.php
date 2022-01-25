<div>
    <x-modal.header title="Sambat" bordered />
    <x-modal.body>
        <div class="overflow-hidden rounded-lg shadow-lg mb-4">
            <div class="px-6 py-4">
                <div class="flex flex-row justify-between mb-4">
                    <div>
                        <h4 class="text-xl font-semibold tracking-tight text-gray-800">{{ $sambat->users->name }}</h4>
                        <p class="font-normal text-yellow-400">{{ $sambat->created_at }}</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <button wire:click="vote({{1}})" id="is_upvote">
                            @if (isset($is_voted) and $is_voted->is_upvote == 1 )
                                <x-icons.thumbs-up-black></x-icons.thumbs-up-black>
                            @else
                                <x-icons.thumbs-up-white></x-icons.thumbs-up-white>
                            @endif
                        </button>
                        <?php
                                $upvote = 0;
                                $downvote = 0;

                                if($sambat->sambat_vote){
                                    foreach ($sambat->sambat_vote as $vote) {
                                        if ($vote->is_upvote == 1) {
                                            $upvote++;
                                        } else {
                                            $downvote++;
                                        }
                                    }
                                }
                            ?>
                            <p class="ml-1 text-xl font-bold">{{ $upvote - $downvote }}</p>
                        <button wire:click="vote({{0}})"  id="is_downvote">
                            @if (isset($is_voted) and $is_voted->is_upvote == 0)
                                <x-icons.thumbs-down-black></x-icons.thumbs-down-black>
                            @else
                                <x-icons.thumbs-down-white></x-icons.thumbs-down-white>
                            @endif
                        </button>
                    </div>
                </div>
                <p class="leading-normal text-gray-700 font-normal text-base mb-4">{!! Str::markdown($sambat->description) !!}</p>
                @foreach ($sambat->tags as $t)
                    <x-badge.secondary text="{{ $t->name }}"></x-badge.secondary>               
                @endforeach
            </div>
        </div>

        <h2 class="mb-2">Komentar</h2>
        @foreach ($sambat_comment as $sc)
        <div class="flex flex-row justify-between p-4">
            <div>
                <h2 class="font-semibold">{{ $sc->sambat->users->name }}</h2>
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

@push('scripts')
<script>
    const voting = (is_upvote) => Livewire.vote(is_upvote);
</script>
@endpush
