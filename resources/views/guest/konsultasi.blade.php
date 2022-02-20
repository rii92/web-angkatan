<x-app-layout title="Konsultasi">
    <x-landingpage.wrapper title="Konsultasi">
        @livewire('guest.konsultasi.konsul-list')
    </x-landingpage.wrapper>

    @push('bottom-menu')
        <div class="h-12 w-12 bg-main rounded-full border-2 border-white" x-data="{open : false}" x-cloak>
            <div class="relative flex justify-center items-center h-full w-full cursor-pointer">
                <x-icons.plus class="text-white hover:text-orange-200 transition duration-150 w-10 h-10 mx-2 my-2" stroke-width='1.5'
                    x-on:click="open = !open" />
                <div class="absolute bg-white rounded-md py-3 -top-24 right-0 shadow-md border" x-show="open"
                    x-on:click.outside="open = false">
                    <a href="{{ route('user.konsultasi.akademik.add') }}"
                        class="px-4 inline-block whitespace-nowrap py-1 hover:bg-gray-100">Konsul
                        Akademik</a>
                    <a href="{{ route('user.konsultasi.umum.add') }}"
                        class="px-4 inline-block w-full whitespace-nowrap py-1 hover:bg-gray-100">Konsul
                        Umum</a>
                </div>
            </div>
        </div>
    @endpush

</x-app-layout>
