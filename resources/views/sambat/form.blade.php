<form wire:submit.prevent="handleForm" class="bg-white m-9 p-9 drop-shadow-2xl rounded-2xl" id="form">
    <div class="flex flex-col justify-between">
        <div class="flex flex-col md:flex-row md:justify-between items-center justify-start">
            <div class="flex flex-col mb-8">
                <label class="block mb-1 font-semibold" for="">Tag</label>
                <div class="flex flex-row">
                   <input wire:model.defer="tag" class="rounded-lg bg-green-200 text-gray-500" type="text" placeholder="Masukan Tag" id="inputTag">
                    <x-button.success class="inline" onclick="newTag()" id="addTag">+</x-button.success>
                </div>
            </div>  
            <ul class="flex flex-row flex-wrap m-4" id="listTags">
                @if ($data->id)
                    @foreach ($data->tags as $tag)
                        <li value="{{ $tag->name }}" class="inline p-2 bg-gray-200 rounded-xl mr-2 listTag">{{ $tag->name }}</li>
                    @endforeach
                @endif
            </ul>
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
        let tags = []
        @if ($data)
            const data_tag = {!! json_encode($data->tags) !!}
            data_tag.forEach(el => {
                tags.push(el.name);
            });
        @endif

        // Create a "close" button and append it to each list item
        const myNodelist = document.getElementsByClassName("listTag");
        let i;
        for (i = 0; i < myNodelist.length; i++) {
            let span = document.createElement("SPAN");
            let txt = document.createTextNode("\u00D7");
            span.className = "mx-2 close font-bold text-xl cursor-pointer";
            span.appendChild(txt);
            myNodelist[i].appendChild(span);
        }

        function arrayRemove(index) {
            tags = tags.filter(el => el !== tags[index]);
        }

        // Click on a close button to hide the current list item
        let close = document.getElementsByClassName("close");
        for (i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function (){
                let div = this.parentElement;
                    arrayRemove(tags, i);
                    div.style.display = "none";
            });
        }

        // Create a new list item when clicking on the "Add" button
        function newTag() {
            let li = document.createElement("li");
            let inputTag = document.getElementById("inputTag").value;
            let t = document.createTextNode(inputTag);
            li.className = 'inline p-2 bg-gray-200 rounded-xl mr-2 listTag';
            li.appendChild(t);
            if (inputTag === '') {
                alert("You must write something!");
            } else {
                if (!tags.find(el => el === inputTag)) { 
                    tags.push(inputTag);
                    document.getElementById("listTags").appendChild(li);
                }
            }
            document.getElementById("inputTag").value = "";

           let span = document.createElement("SPAN");
           let txt = document.createTextNode("\u00D7");
            span.className = "mx-2 close font-bold text-xl cursor-pointer";
            span.appendChild(txt);
            li.appendChild(span);

            for (i = 0; i < close.length; i++) {
                close[i].addEventListener('click', function (){
                let div = this.parentElement;
                    arrayRemove(tags, i);
                    div.style.display = "none";
                });
            }
        }
    </script>
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

