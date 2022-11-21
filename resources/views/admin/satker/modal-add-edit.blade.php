<form wire:submit.prevent="handleForm" class="mb-4">
    <x-modal.header title="{{ $satker_id ? __('Update Satuan Kerja') : __('Buat Satuan Kerja Baru') }}" bordered />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="satker.kode_wilayah" value="Kode Wilayah Satker" />
            <x-input.text wire:model.defer="satker.kode_wilayah" id="kode_wilayah" type="number" min="0"
                value="0" />
            <x-input.error for="satker.kode_wilayah" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="satker.name" value="{{ __('Nama Satker') }}" />
            <x-input.text wire:model.defer="satker.name" id="name" type="text" placeholder="BPS Pulang Pisau" />
            <x-input.error for="satker.name" />
        </x-input.wrapper>

        <x-input.wrapper class="relative" x-data="{ search: false }">
            <x-input.label for="locationSearch" value="Kabupaten" />
            <x-input.text id="locationSearch" placeholder="Kota Metro" wire:model="locationSearch"
                x-on:input="search = true" />
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

        @foreach (App\Constants\AppSimulation::BASED_ON() as $key => $item)
            <x-input.wrapper>
                <x-input.label for="satker.{{ $key }}" value="Formasi {{ $item }}" />
                <x-input.text wire:model.defer="satker.{{ $key }}" id="{{ $key }}" type="number" min="0"
                    value="0" />
                <x-input.error for="satker.{{ $key }}" />
            </x-input.wrapper>
        @endforeach

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
