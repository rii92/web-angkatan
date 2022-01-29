<x-dashboard-layout title="{{ $title }}">
    @if ($menu == 'table')
        <x-card.base title="Konsultasi List">
            @slot('aside')
                <div class="flex items-center">
                    <x-anchor.success href="{{ route('user.konsultasi.' . $category . '.add') }}">
                        <x-icons.plus stroke-width="2.5" width="16" height="16" />
                        <span class="ml-2">Konsultasi {{ ucwords($category) }}</span>
                    </x-anchor.success>
                </div>
            @endslot

            @livewire('mahasiswa.konsultasi.table', ['category'=> $category])

            <p class="text-gray-400 text-sm mt-3 leading-tight">
                Data konsultasi masih dapat kamu edit dan hapus selama statusnya masih
                <x-badge.warning text="{{ AppKonsul::STATUS_WAIT }}" class="mr-0" />Jika statusnya sudah
                berubah maka hanya konseler yang bisa menghapusnya
            </p>

        </x-card.base>
    @endif

    @if ($menu == 'add-edit')
        <x-card.base title="{{ $subtitle }}">
            @livewire('mahasiswa.konsultasi.form', ['category' => $category, 'konsul_id' => $konsul_id ?? null])
        </x-card.base>
    @endif

    @if ($menu == 'room')
        @livewire('mahasiswa.konsultasi.discussion-room', ['konsul' => $konsul_id]);
    @endif

    @if (session('message'))
        @push('scripts')
            <script>
                Livewire.emit('success', "{{ session('message') }}")
            </script>
        @endpush
    @endif

    @if (session('error'))
        @push('scripts')
            <script>
                Livewire.emit('error', "{{ session('error') }}")
            </script>
        @endpush
    @endif
</x-dashboard-layout>
