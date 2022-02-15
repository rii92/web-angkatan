<x-card.base title="{{ $title }}">
    <form wire:submit.prevent="handleForm" class="mb-4" id="form">

        <div class="grid md:grid-cols-6 grid-cols-1 md:gap-x-3">
            <x-input.wrapper class="md:col-span-4">
                <x-input.label for="announcement.title" value="{{ __('Announcement Title') }}" />
                <x-input.text wire:model.defer="announcement.title" id="name" type="text" />
                <x-input.error for="announcement.title" />
            </x-input.wrapper>

            <x-input.wrapper class="md:col-span-2">
                <x-input.label for="announcement.published_at" value="{{ __('Publish Date and Time') }}" />
                <x-input.text wire:model.defer="announcement.published_at" id="published_at" type="datetime-local" />
                <x-input.error for="announcement.published_at" />
            </x-input.wrapper>
        </div>

        <x-input.wrapper class="md:-mt-2">
            <x-input.label for="announcement.content" value="{{ __('Content') }}" class="mb-1" />
            <div wire:ignore>
                <div id="editor"></div>
            </div>
            <x-input.error for="announcement.content" />
        </x-input.wrapper>


        <div class="flex justify-between mt-6 items-center">
            <p class="text-xs text-gray-500 mr-3">
                {{ $announcement->updated_at ? "Last Update : {$announcement->updated_at->format('d M Y h:i A')}" : '' }}
            </p>
            <div class="flex">
                <x-anchor.secondary href="{{ route('admin.announcement.table') }}">
                    Back
                </x-anchor.secondary>
                <x-button.black x-on:click="submitForm" class="ml-2">
                    {{ $announcement_id ? 'Save' : 'Submit' }}
                </x-button.black>
            </div>
        </div>

        @push('scripts')
            <script src="{{ mix('js/editor.js') }}" defer></script>
            <script>
                let editor;
                const submitForm = () => Livewire.emit('submitForm', editor.getMarkdown());

                document.addEventListener("DOMContentLoaded", function() {
                    editor = new Editor({
                        el: document.querySelector('#editor'),
                        previewStyle: 'tab',
                        height: '500px',
                        initialValue: @this.announcement.content
                    });
                });
            </script>
        @endpush
    </form>
</x-card.base>
