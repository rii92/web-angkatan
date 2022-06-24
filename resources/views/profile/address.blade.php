<x-card.form>
    <x-slot name="title">
        {{ __('Your Address') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update Your Full Address, Province, and Regency') }}
    </x-slot>

    <form wire:submit.prevent="handleForm">
        <x-input.wrapper>
            <x-input.label for="details.alamat_rumah" value="{{ __('Alamat Lengkap Rumah') }}" />
            <x-input.textarea id="details.alamat_rumah" wire:model.defer="details.alamat_rumah" type="text"
                rows="4" />
            <x-input.error for="details.alamat_rumah" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.alamat_kos" value="{{ __('Alamat Lengkap Kos') }}" />
            <x-input.textarea id="details.alamat_kos" wire:model.defer="details.alamat_kos" type="text"
                rows="4" />
            <x-input.error for="details.alamat_kos" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.link_map_kosan" value="{{ __('Link Google Maps Kos') }}" />
            <x-input.textarea id="details.link_map_kosan" wire:model.defer="details.link_map_kosan" type="text"
                rows="2" />
            <x-input.error for="details.link_map_kosan" />
        </x-input.wrapper>

        <x-input.wrapper class="relative" x-data="{ search: false }">
            <x-input.label for="kabupaten" value="Kabupaten Asal" />
            <x-input.text id="kabupaten" placeholder="Kota Metro" wire:model="kabupaten" x-on:input="search = true" />
            {{-- dropdown auto search. limit search 3 items, because modal is overflow:hidden --}}
            @if ($kabupaten)
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
            <x-input.error for="kabupaten" />

        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.tanggal_ke_jakarta" value="{{ __('Tanggal Ke Jakarta') }}" />
            <x-input.caption>Jika berdomisili atau sudah lama berada di Jakarta biarkan kosong</x-input.caption>
            <x-input.text id="details.tanggal_ke_jakarta" wire:model.defer="details.tanggal_ke_jakarta"
                type="date" />
            <x-input.error for="details.tanggal_ke_jakarta" />
        </x-input.wrapper>

        <div class="flex justify-end mt-6 items-center">
            <span class="mr-3 text-sm" wire:loading wire:target="handleForm">Saving...</span>

            <x-button.black type="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>
