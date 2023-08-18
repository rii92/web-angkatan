@props(['konsul'])

@php
    $photo = $konsul->is_anonim ? url('img/user-avatar.svg') : $konsul->user->profile_photo_url;
    $name = $konsul->is_anonim ? 'Anonim' : $konsul->user->name;
    $kelas = $konsul->is_anonim ? "Jurusan {$konsul->userdetails->jurusan_short}" : "{$konsul->userdetails->nim}/{$konsul->userdetails->kelas}";
@endphp

<div class="mb-8">
    <div class="p-5 mt-3 bg-white border border-gray-200 rounded-lg shadow-xl">
        <div class="flex items-center mb-5">
            <img src="{{ $photo }}" alt="{{ $name }}"
                class="w-10 h-10 mr-3 border border-gray-200 rounded-full shadow-md sm:h-12 sm:w-12">
            <div class="flex flex-col">
                <a href="{{ route('konsultasi.detail', ['slug' => $konsul->slug]) }}">
                    <h2 class="text-lg text-orange-500 md:text-2xl hover:text-orange-600">
                        {{ $konsul->title }}
                        <x-konsultasi.category category="{{ $konsul->category }}" />
                    </h2>
                </a>
                <small class="text-sm tracking-wide text-darker">
                    {{ $name }} | {{ $kelas }} | {{ $konsul->published_at->format('d M Y H:i') }} WIB
                </small>
            </div>
        </div>
        <article class="text-sm tracking-wide text-gray-800 font-poppins">
            {{ Str::limit(strip_tags(Str::markdown($konsul->description)), 1500, '...') }}
        </article>
        <div class="flex items-center justify-between mt-3">
            <div>
                @foreach ($konsul->tags as $tag)
                    <x-badge.success text="{{ $tag->name }}"
                        class="mr-0 transition cursor-pointer hover:bg-blue-sidebar hover:text-green-100"
                        wire:click="$emitSelf('selectTag', '{{ '#' . $tag->name }}')"
                        onclick="window.scrollTo({ top: 70, behavior: 'smooth' });" />
                @endforeach
            </div>
        </div>
    </div>
</div>
