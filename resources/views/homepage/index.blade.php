<x-app-layout title="Web Angkatan 60">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <x-card.base title="Isi datanya dulu ya">
                    @slot('aside')
                        <div class="flex">
                            @hasanyrole(AppRoles::USERS . '|' . AppRoles::D3_61)
                                <div class="flex items-center">
                                    <x-button.success onclick="Livewire.emit('openModal', 'skripsi.modal-update')">
                                        <x-icons.plus stroke-width="2.5" width="16" height="16" />
                                        <span class="ml-2">Update My Skripsi</span>
                                    </x-button.success>
                                </div>
                            @endhasanyrole
                            @role(AppRoles::ADMIN)
                                <div class="ml-2">@livewire('admin.examples.send-mail')</div>
                            @endrole
                        </div>
                    @endslot
                    @livewire('skripsi.table')
                </x-card.base>
            @else
                <x-card.base class="text-center flex justify-center">
                    <div>
                        <img src="https://imgs.xkcd.com/comics/confounding_variables.png" alt="xkcd" class="mx-auto">
                        <div class="uppercase mt-5 font-bold text-gray-600">
                            under development, BUT YOU CAN LOGIN.
                        </div>
                        <div class="uppercase font-bold text-gray-600">
                            For first time login, you must use your STIS email. After
                            that you can change your password in the profile menu.
                        </div>
                    </div>
                </x-card.base>
            @endauth
        </div>
    </div>
</x-app-layout>
