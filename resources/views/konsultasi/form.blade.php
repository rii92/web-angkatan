<form wire:submit.prevent="handleForm" class="mb-4" id="form">

    <div class="grid md:grid-cols-6 grid-cols-1 md:gap-x-3" style="margin: -20px 0;">
        <x-input.wrapper class="md:col-span-3">
            <x-input.label for="konsul.title" value="{{ __('konsul Title') }}" />
            <x-input.text wire:model.defer="konsul.title" id="name" type="text" />
            <x-input.error for="konsul.title" />
        </x-input.wrapper>
        <x-input.wrapper class="md:col-span-1">
            <x-input.label for="konsul.is_publish" value="{{ __('Publish') }}" />
            <x-input.checkbox wire:model.defer="konsul.is_publish" />
            <x-input.error for="konsul.is_publish" />
        </x-input.wrapper>
        <x-input.wrapper class="md:col-span-1">
            <x-input.label for="konsul.is_anonim" value="{{ __('Anonim') }}" />
            <x-input.checkbox wire:model.defer="konsul.is_anonim" />
            <x-input.error for="konsul.is_anonim" />
        </x-input.wrapper>
        <x-input.wrapper class="md:col-span-1">
            <x-input.label for="konsul.status" value="{{ __('Status') }}" />
            <x-input.checkbox wire:model.defer="konsul.status" />
            <x-input.error for="konsul.status" />
        </x-input.wrapper>
    </div>

    {{-- @dump($konsul) --}}
    @if ($konsul->id)
    <div class="m-4">
        @livewire('konsultasi.chat', ['konsul_id'=>$konsul->id])
    </div>
    @endif

    <x-input.wrapper class="md:-mt-2">
        <x-input.label for="konsul.chat" value="{{ __('') }}" class="mb-1" />
        <div wire:ignore>
            <div id="editor"></div>
        </div>
        <x-input.error for="konsul.chat" />
    </x-input.wrapper>

    <div class="flex justify-between mt-6 items-center">
        <p class="text-xs text-gray-500 mr-3">
            {{ $konsul->updated_at ? "Last Update : {$konsul->updated_at->format('d M Y h:i A')}" : ""}}
        </p>
        <div class="flex">
            <x-anchor.secondary href="{{ route('admin.konsultasi-'.$konsul->catagory) }}">
                Back
            </x-anchor.secondary>
            <x-button.black x-on:click="submitForm" class="ml-2">
                {{ $konsul_id ? "Save" : "Submit" }}
            </x-button.black>
        </div>
    </div>

    @push('scripts')
    <script src="{{ mix('js/editor.js') }}" defer></script>
    <script>
        let editor;
        const submitForm = () => Livewire.emit('submitForm', editor.getMarkdown());

        document.addEventListener("DOMContentLoaded", function(){
            editor = new Editor({
                el: document.querySelector('#editor'),
                previewStyle: 'tab',
                height: '200px',
                initialValue : @this.konsul.chat
            });
        });
    </script>
    @endpush
</form>
