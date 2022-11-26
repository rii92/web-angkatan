<x-app-layout title="Konsultasi">
    <x-landingpage.wrapper title="Konsultasi">
        @livewire('guest.konsultasi.konsul-list')
    </x-landingpage.wrapper>

    @push('bottom-menu')
        <div class="w-12 h-12 border-2 border-white rounded-full bg-main" x-data="{open : false}" x-cloak>
            <div class="relative flex items-center justify-center w-full h-full cursor-pointer">
                <x-icons.plus class="w-10 h-10 mx-2 my-2 text-white transition duration-150 hover:text-orange-200" stroke-width='1.5'
                    x-on:click="open = !open" />
                <div class="absolute right-0 py-3 bg-white border rounded-md shadow-md -top-24" x-show="open"
                    x-on:click.outside="open = false">
                    <a href="{{ route('user.konsultasi.akademik.add') }}"
                        class="inline-block px-4 py-1 whitespace-nowrap hover:bg-gray-100">Konsul
                        Akademik</a>
                    <a href="{{ route('user.konsultasi.umum.add') }}"
                        class="inline-block w-full px-4 py-1 whitespace-nowrap hover:bg-gray-100">Konsul
                        Umum</a>
                </div>
            </div>
        </div>
    @endpush

</x-app-layout>
