<x-app-layout title="Konsultasi">
    <x-landingpage.wrapper title="Konsultasi">
        @livewire('guest.konsultasi.konsul-list')

        <div class="h-10 w-10 bg-main fixed bottom-10 right-10 rounded-full border-2 border-white"
            x-data="{open : false}" x-cloak>
            <div class="relative flex justify-center items-center h-full w-full cursor-pointer">
                <x-icons.plus class="text-white" stroke-width='3' x-on:click="open = !open" />

                <div class="absolute bg-white rounded-md py-3 -top-24 right-0 shadow-md border" x-show="open"
                    x-on:click.outside="open = false">
                    <a target="_blank" href="{{ route('user.konsultasi.akademik.add') }}"
                        class="px-4 inline-block whitespace-nowrap py-1 hover:bg-gray-100"
                        x-on:click="open = false">Konsul
                        Akademik</a>
                    <a target="_blank" href="{{ route('user.konsultasi.umum.add') }}"
                        class="px-4 inline-block w-full whitespace-nowrap py-1 hover:bg-gray-100"
                        x-on:click="open = false">Konsul
                        Umum</a>
                </div>
            </div>
        </div>
    </x-landingpage.wrapper>


</x-app-layout>
