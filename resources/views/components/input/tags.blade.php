@props(['init' => '', 'className'])

<div wire:ignore>
    <div x-data="{tags : []}" x-init="tags = '{{ $init }}'.split(' ').filter((text) => text != '');">
        <x-input.text autocomplete="off" :attributes="$attributes" type="text"
            placeholder="Setiap tag dipisahkan oleh spasi" x-ref="input"
            x-on:keyup="const tag = $refs.input.value; const tagTrim = tag.trim(); if (tag.slice(-1) == ' ' && tagTrim.length > 0 && !tags.includes(tagTrim)) {tags.push(tagTrim.toLowerCase())} if (tag.slice(-1) == ' ' || tags.includes(tagTrim)){$refs.input.value = ''} tags.length == 5 ? $refs.input.disabled = true : ''" />
        <div class="mt-2">
            <template x-for="(tag, index) in tags" :key="index">
                <div class="relative inline-flex">
                    <x-badge.success x-text="tag" text="" class="pr-7 {{ $className }}" />
                    <x-icons.close class="absolute right-4 top-0.5 transform scale-75 cursor-pointer" width="15"
                        height="15"
                        x-on:click="tags = tags.filter((tag, i) => index != i); $refs.input.disabled = false" />
                </div>
            </template>
        </div>
    </div>
</div>
