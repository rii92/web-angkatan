<div title="{{ $konsul->is_anonim ? 'Anonim' : $konsul->user->name }}"
    class="block md:flex flex-row-reverse pb-2 md:pb-4 mb-4 border-b border-gray-200">
    {{-- body --}}
    <div class="flex-1 py-4 px-2 md:ml-2 hover:bg-gray-50 transition duration-100">
        <div class="flex items-center pb-2  ">
            <div class="w-10 h-10">
                @if ($konsul->is_anonim)
                    <img class="object-cover w-full mr-2" src="{{ url('img/user-avatar.png') }}"
                        alt="{{ $konsul->user->name }}" />
                @else
                    <img class="object-cover w-full rounded-full mr-2" src="{{ $konsul->user->profile_photo_url }}"
                        alt="{{ $konsul->user->name }}" />
                @endif
            </div>
            <div class="ml-2">
                <div class="font-bold text-sm text-gray-600">
                    {{ $konsul->is_anonim ? 'Anonim' : $konsul->user->name }} | {{ $konsul->title }}
                </div>
                <div class="text-xs">
                    {{ $konsul->created_at }}
                </div>
            </div>
        </div>
        <div class="my-2">
            <x-badge.primary text="{{ $konsul->category }}" />
            @foreach ($konsul->tags as $tag)
                <x-badge.black text="{{ $tag->name }}" />
            @endforeach
        </div>
        <div class=" flex justify-between">
            <div class="prose font-sans">
                @if ($konsul->image)
                    <div class="mb-2">
                        <img src="{{ Storage::disk('public')->url($konsul->image->url) }}"
                            alt="{{ $konsul->id }}">
                    </div>
                @endif
                {!! Str::markdown($konsul->description) !!}
            </div>
            <x-anchor.black class="m-2 h-8" onclick="Livewire.emit('openModal', 'konsultasi.modal-detail' , {{ json_encode(['konsul' => $konsul]) }})">
                <x-icons.chat stroke-width="2.5" width="16" height="16" />
                <span class="hidden md:inline-block ml-2 text-xs">Lihat</span>
            </x-anchor.black>
        </div>
    </div>
    {{-- @dump($konsul->get()) --}}
</div>
