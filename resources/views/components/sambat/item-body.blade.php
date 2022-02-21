@props(['sambat', 'name', 'photo'])


<div class="flex items-center mb-2">
    <div class="w-12 h-12">
        <img class="object-cover w-full rounded-full mr-2 border shadow-sm" src="{{ $photo }}"
            alt="{{ $name }}" />
    </div>
    <div class="ml-2">
        <div class="font-bold text-xl text-orange-600">
            {{ $name }}
        </div>
        <div class="text-sm">
            <span class="mr-2">{{ $sambat->created_at->format('d-M H:i') }}</span>
            @foreach ($sambat->tags as $tag)
                <x-badge.success text="{{ $tag->name }}" class="mr-0 cursor-pointer hover:bg-green-400 hover:text-green-100 transition"
                        wire:click="$emit('selectTag', '{{ '#' . $tag->name }}')"
                        onclick="window.scrollTo({ top: 70, behavior: 'smooth' });" />
            @endforeach

            @if ($sambat->created_at != $sambat->updated_at)
                <small class="italic text-xs whitespace-nowrap">Diedit pada
                    {{ $sambat->updated_at->format('d-M H:i') }}</small>
            @endif
        </div>
    </div>
</div>

<div x-data="descriptionSambat(@this.description)" x-cloak>
    <div class="prose font-sans chat chat-guest max-w-none" x-html="displayText"></div>
    <div x-show="needReadMore" class="text-blue-500 hover:text-blue-600 underline text-xs cursor-pointer transition">
        <span x-show="!showFull" x-on:click="showFullText">Show More</span>
        <span x-show="showFull" x-on:click="showLessText">Show Less</span>
    </div>

    <div class="flex justify-center md:justify-start">
        <div class="inline-flex sm:max-h-64 max-h-52 overflow-hidden border rounded-xl mt-3 hover:opacity-90 transition"
            x-on:mouseover="initViewer($el)">
            @foreach ($sambat->images as $image)
                <div class="relative {{ $loop->first ? '' : 'ml-1' }} {{ $loop->index < 3 ? '' : 'hidden' }} {{ $loop->index == 2 ? 'sm:block hidden' : '' }}"
                    x-data>
                    <img src="{{ Storage::disk('public')->url($image->url) }}" alt="{{ $image->id }}"
                        class="sm:min-h-64 min-h-52 max-h-80 cursor-pointer" x-ref="image">

                    @if (in_array($loop->index, [1, 2]) && $loop->count > 3)
                        <span
                            class="absolute z-10 right-0 left-0 top-0 bottom-0 flex justify-center items-center bg-black bg-opacity-20 font-archivo-narrow text-gray-100 sm:text-4xl text-2xl cursor-pointer {{ $loop->index == 2 ? '' : 'sm:hidden' }}"
                            x-on:click="$refs.image.click()">
                            {{ $loop->remaining }}+
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
