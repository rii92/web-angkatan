@props(['konsul'])

@php
$photo = $konsul->is_anonim ? 'https://ui-avatars.com/api/?name=Anonim&color=7F9CF5&background=EBF4FF' : $konsul->user->profile_photo_url;
$name = $konsul->is_anonim ? 'Anonim' : $konsul->user->name;
$kelas = $konsul->is_anonim ? "Jurusan {$konsul->userdetails->jurusan}" : "{$konsul->userdetails->nim}/{$konsul->userdetails->kelas}";
@endphp

<div class="mb-8">
    <div class="flex items-center">
        <img src="{{ $photo }}" alt="{{ $name }}"
            class="rounded-full mr-3 border border-gray-200 shadow-md sm:h-12 sm:w-12 w-10 h-10">
        <div class="flex flex-col">
            <h2 class="leading-tight md:text-2xl text-lg">
                {{ $konsul->title }}
                <x-konsultasi.category category="{{ $konsul->category }}" />
            </h2>
            <small class="text-gray-500">{{ $name }} | {{ $kelas }} |
                {{ $konsul->published_at->format('d M Y H:i') }} WIB</small>
        </div>
    </div>

    <div class="bg-light-4 bg-opacity-30 p-5 rounded-lg mt-3 shadow-lg border border-gray-300">
        <article class="text-gray-800">
            {{ Str::limit(strip_tags(Str::markdown($konsul->description)), 1500, '...') }}
        </article>
        <div class="flex justify-between items-center mt-3">
            <div>
                @foreach ($konsul->tags as $tag)
                    <x-badge.success text="{{ $tag->name }}" class="mr-0 cursor-pointer"
                        wire:click="$emitSelf('selectTag', '{{ '#' . $tag->name }}')"
                        onclick="window.scrollTo({ top: 70, behavior: 'smooth' });" />
                @endforeach
            </div>
            <x-anchor.black class="ml-3"
                href="{{ route('konsultasi.detail', ['slug' => $konsul->slug]) }}">
                Lihat
            </x-anchor.black>
        </div>
    </div>
</div>
