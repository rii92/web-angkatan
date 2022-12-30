@props(['sambat', 'name', 'photo'])


<div class="flex items-center mb-2">
    <div class="w-12 h-12">
        <img class="object-cover w-full mr-2 border rounded-full shadow-sm" src="{{ $photo }}"
            alt="{{ $name }}" />
    </div>
    <div class="ml-2">
        <div class="text-xl font-bold text-orange-600">
            {{ $name }}
        </div>
        <div class="text-sm">
            <span class="mr-2">{{ $sambat->created_at->format('d-M H:i') }}</span>
            @foreach ($sambat->tags as $tag)
                <x-badge.success text="{{ $tag->name }}" class="mr-0 transition cursor-pointer hover:bg-blue-sidebar hover:text-green-100"
                        wire:click="$emit('selectTag', '{{ '#' . $tag->name }}')"
                        onclick="window.scrollTo({ top: 70, behavior: 'smooth' });" />
            @endforeach

            @if ($sambat->created_at != $sambat->updated_at)
                <small class="text-xs italic whitespace-nowrap">Diedit pada
                    {{ $sambat->updated_at->format('d-M H:i') }}</small>
            @endif
        </div>
    </div>
</div>

<div x-data="descriptionSambat(@this.description)" x-cloak>
    <div class="font-sans prose chat chat-guest max-w-none" x-html="displayText"></div>
    <div x-show="needReadMore" class="text-xs text-blue-500 underline transition cursor-pointer hover:text-blue-600">
        <span x-show="!showFull" x-on:click="showFullText">Show More</span>
        <span x-show="showFull" x-on:click="showLessText">Show Less</span>
    </div>

    <div class="flex justify-center md:justify-start">
        <div class="inline-flex mt-3 overflow-hidden transition border sm:max-h-64 max-h-52 rounded-xl hover:opacity-90"
            x-on:mouseover="initViewer($el)">
            @foreach ($sambat->images as $image)
                <div class="relative {{ $loop->first ? '' : 'ml-1' }} {{ $loop->index < 3 ? '' : 'hidden' }} {{ $loop->index == 2 ? 'sm:block hidden' : '' }}"
                    x-data>
                    <img src="{{ Storage::disk('public')->url($image->url) }}" alt="{{ $image->id }}"
                        class="cursor-pointer sm:min-h-64 min-h-52 max-h-80" x-ref="image">

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
