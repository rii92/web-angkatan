<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $satker_id ? __('Update Satuan Kerja') : __('Buat Satuan Kerja Baru') }}" bordered />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="satker.name" value="{{ __('satkers Name') }}" />
            <x-input.text wire:model.defer="satker.name" id="name" type="text" />
            <x-input.error for="satker.name" />
        </x-input.wrapper>

        <x-input.wrapper class="relative" x-data="{ search: false }">
            <x-input.label for="locationSearch" value="Kabupaten Asal" />
            <x-input.text id="locationSearch" placeholder="Kota Metro" wire:model="locationSearch" x-on:input="search = true" />
            {{-- dropdown auto search. limit search 3 items, because modal is overflow:hidden --}}
            @if ($locationSearch)
                <ul x-show="search" @click.away="search = false"
                    class="absolute left-0 w-full bg-white border border-gray-200 rounded-md shadow-sm text-sm">
                    @forelse($locations as $loc)
                        <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                            wire:click="selectLocation('{{ $loc->kabupaten }}')" x-on:click="search=false">
                            <p> {{ $loc->kabupaten }}, {{ $loc->provinsi }} </p>
                        </li>
                    @empty
                        <li class="px-4 py-2 italic">
                            <p>No location found</p>
                        </li>
                    @endforelse
                </ul>
            @endif
            {{-- don't move it --}}
            <x-input.error for="locationSearch" />

        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.se" value="{{ __('Formasi Statistik Ekonomi') }}" />
            <x-input.text wire:model.defer="satker.se" id="se" type="number" min="0" value="0" />
            <x-input.error for="satker.se" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.sk" value="{{ __('Formasi Statistik Kependudukan') }}" />
            <x-input.text wire:model.defer="satker.sk" id="sk" type="number" min="0" value="0" />
            <x-input.error for="satker.sk" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.si" value="{{ __('Formasi Sistem Informasi Statistik') }}" />
            <x-input.text wire:model.defer="satker.si" id="si" type="number" min="0" value="0" />
            <x-input.error for="satker.si" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.sd" value="{{ __('Formasi Data Science') }}" />
            <x-input.text wire:model.defer="satker.sd" id="sd" type="number" min="0" value="0" />
            <x-input.error for="satker.sd" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.st" value="{{ __('Formasi DIV Statistik') }}" />
            <x-input.text wire:model.defer="satker.st" id="st" type="number" min="0" value="0" />
            <x-input.error for="satker.st" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.ks" value="{{ __('Formasi DIV Komputasi Statistik') }}" />
            <x-input.text wire:model.defer="satker.ks" id="ks" type="number" min="0" value="0" />
            <x-input.error for="satker.ks" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.d3" value="{{ __('Formasi DIII Statistik') }}" />
            <x-input.text wire:model.defer="satker.d3" id="d3" type="number" min="0" value="0" />
            <x-input.error for="satker.d3" />
        </x-input.wrapper>
        

    </x-modal.body>
    <x-modal.footer>
        <x-button.black type="submit">
            Submit
        </x-button.black>
        <x-button.secondary class="ml-2" wire:click="$emit('closeModal')">
            Close
        </x-button.secondary>
    </x-modal.footer>
</form>
