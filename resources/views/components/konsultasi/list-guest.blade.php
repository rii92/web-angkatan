@props(['konsul'])

@php
    $photo = $konsul->is_anonim ? url('img/user-avatar.svg') : $konsul->user->profile_photo_url;
    $name = $konsul->is_anonim ? 'Anonim' : $konsul->user->name;
    $kelas = $konsul->is_anonim ? "Jurusan {$konsul->userdetails->jurusan_short}" : "{$konsul->userdetails->nim}/{$konsul->userdetails->kelas}";
@endphp

<div class="mb-8">
    <div class="bg-white p-5 rounded-lg mt-3 shadow-xl border border-gray-200">
        <div class="flex items-center mb-5">
            <img src="{{ $photo }}" alt="{{ $name }}"
                class="rounded-full mr-3 border border-gray-200 shadow-md sm:h-12 sm:w-12 w-10 h-10">
            <div class="flex flex-col">
                <a href="{{ route('konsultasi.detail', ['slug' => $konsul->slug]) }}">
                    <h2 class="md:text-2xl text-lg text-orange-500 hover:text-orange-600">
                        {{ $konsul->title }}
                        <x-konsultasi.category category="{{ $konsul->category }}" />
                    </h2>
                </a>
                <small class="text-darker text-sm tracking-wide">
                    {{ $name }} | {{ $kelas }} | {{ $konsul->published_at->format('d M Y H:i') }} WIB
                </small>
            </div>
        </div>
        <article class="text-gray-800 font-poppins text-sm tracking-wide">
            {{ Str::limit(strip_tags(Str::markdown($konsul->description)), 1500, '...') }}
        </article>
        <div class="flex justify-between items-center mt-3">
            <div>
                @foreach ($konsul->tags as $tag)
                    <x-badge.success text="{{ $tag->name }}"
                        class="mr-0 cursor-pointer hover:bg-green-400 hover:text-green-100 transition"
                        wire:click="$emitSelf('selectTag', '{{ '#' . $tag->name }}')"
                        onclick="window.scrollTo({ top: 70, behavior: 'smooth' });" />
                @endforeach
            </div>
        </div>
    </div>
</div>
