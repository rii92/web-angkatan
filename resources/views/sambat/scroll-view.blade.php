<div>
    <div class="w-full bg-white my-9 p-9 rounded-2xl">
        <h3 class="font-semibold text-md">Like Terbanyak</h3>
        <div class="h-screen overflow-y-scroll scrollbar-thin scrollbar-thumb-blue-700 scrollbar-track-blue-300 scrollbar-thumb-rounded-full scrollbar-track-rounded-full">
            @foreach ($votes as $v)
                <div 
                class="bg-white p-4 m-4 duration-300 ease-in-out hover:bg-emerald-900 hover:drop-shadow-lg hover:text-white hover:-translate-y-1 hover:scale-105 rounded-md hover:cursor-pointer" 
                onclick="Livewire.emit('openModal', 'sambat.sambat-detail', {{ json_encode(['sambat_id' => $v->sambat_id]) }})">
                    <h3 class="font-semibold">{{ $v->is_anonim ? "Anonim" : $v->name }}</h3>
                    <p class="mb-2">{{ $v->description }}</p>
                    <div class="flex flex-row items-center">
                        <x-icons.thumbs-up-white></x-icons.thumbs-up-white>
                        <p class="text-xl font-bold mx-2">{{ $v->total }}</p></div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>