<x-app-layout title="{{ $meeting->name }}">
    <x-landingpage.wrapper title="{{ $meeting->name }}">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-card.base class="text-sm">
                {{ $meeting->description }}
                @if ($meeting->is_open)
                    <div class="mt-4 mb-4 italic">
                        * This form will be associated with
                        <span class="font-bold text-gray-700">
                            {{ auth()->user()->name }} ({{ auth()->user()->email }})
                        </span>
                    </div>
                    @livewire('mahasiswa.form.meeting', ['meeting_id' => $meeting->id], key($meeting->id))
                @else
                    <div class="text-red-400 font-bold text-center uppercase">
                        This form is closed
                    </div>
                @endif
            </x-card.base>
        </div>
    </x-landingpage.wrapper>
</x-app-layout>
