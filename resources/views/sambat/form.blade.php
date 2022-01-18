<form wire:submit.prevent="handleForm" class="bg-white m-9 p-9 drop-shadow-2xl rounded-2xl" id="form">
    <div class="flex flex-col">
        <div class="flex justify-between items-center">
            <div class="mb-8">
                <label class="block mb-1 font-semibold" for="">Tag</label>
                <input wire:model.defer="tag" class="rounded-lg bg-green-200 text-gray-500" type="text" placeholder="Masukan Tag">
            </div>  
        </div>
    
        <div class="mb-5">
            <label class="block mb-1 font-semibold" for="">Deskripsi</label>
            <div id="editor" wire:ignore></div>
        </div>

        <div class="flex items-center mb-8">        
            <input wire:model.defer="is_anonim" type="checkbox" value="1" class="mr-2 rounded-sm">
            <label class="font-medium" for="">Anonim</label>
        </div>
    
        <button onclick="submitForm()" type="button" class="w-full hover:-translate-y-1 hover:scale-105 duration-300 py-1 text-base font-medium text-white bg-orange-400 rounded-xl drop-shadow-2xl px-7">Kirim</button>
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
                height: '500px',
                initialValue : @this.description
            });
        });
    </script>
    @endpush
</form>

