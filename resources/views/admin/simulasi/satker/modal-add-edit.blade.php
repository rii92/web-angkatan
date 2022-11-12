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
            <x-input.label for="satker.se_formation" value="{{ __('Formasi Statistik Ekonomi') }}" />
            <x-input.text wire:model.defer="satker.se_formation" id="se_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.se_formation" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.sk_formation" value="{{ __('Formasi Statistik Kependudukan') }}" />
            <x-input.text wire:model.defer="satker.sk_formation" id="sk_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.sk_formation" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.si_formation" value="{{ __('Formasi Sistem Informasi Statistik') }}" />
            <x-input.text wire:model.defer="satker.si_formation" id="si_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.si_formation" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.sd_formation" value="{{ __('Formasi Data Science') }}" />
            <x-input.text wire:model.defer="satker.sd_formation" id="sd_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.sd_formation" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.st_formation" value="{{ __('Formasi DIV Statistik') }}" />
            <x-input.text wire:model.defer="satker.st_formation" id="st_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.st_formation" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.ks_formation" value="{{ __('Formasi DIV Komputasi Statistik') }}" />
            <x-input.text wire:model.defer="satker.ks_formation" id="ks_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.ks_formation" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.d3_formation" value="{{ __('Formasi DIII Statistik') }}" />
            <x-input.text wire:model.defer="satker.d3_formation" id="d3_formation" type="number" min="0" value="0" />
            <x-input.error for="satker.d3_formation" />
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
