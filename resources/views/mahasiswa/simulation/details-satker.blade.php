<x-dashboard-layout title="{{ $simulation->title }}">
    <x-card.base>

        @if ($type == 'kab')
            <h1 class="font-bold mb-2">{{ $satker->full_name }} - {{ $satker->location->provinsi }}</h1>
        @else
            <h1 class="font-bold mb-2">Provinsi {{ $satker->provinsi }}</h1>
        @endif

        <div class="lg:flex">
            @foreach (AppSimulation::BASED_ON() as $key => $value)
                <table class="w-full lg:w-auto lg:flex-1 text-center mb-4">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 border" colspan="5">
                                {{ strtoupper($key) }}
                            </th>
                        </tr>
                        <tr>
                            @foreach (['Formasi', 'Final', 'P1', 'P2', 'P3'] as $c)
                                <th scope="col"
                                    class="text-sm font-medium text-gray-900 px-2 py-2 border {{ in_array($c, ['Formasi', 'Final']) ? 'bg-yellow-100' : '' }}">
                                    {{ $c }}
                                </th>
                            @endforeach
                        </tr>
                    </thead class="border-b">
                    <tbody>
                        <tr class="bg-white border-b">
                            @foreach ([$key, "formation_final_$key", "formation_1_$key", "formation_2_$key", "formation_3_$key"] as $key2)
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border">
                                    {{ $satker->{$key2} }}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </div>

        @if ($type == 'kab')
            @livewire('mahasiswa.simulation.satker-detail-kab-table', ['simulation_id' => $simulation->id, 'satker_id' => $satker->id])
        @else
            <p class="text-gray-400 text-sm mb-3 leading-tight">
                Selain isian kolom formasi masih ada kesalahan penghitungan jumlahnya. Hal ini sedang kami perbaiki.
            </p>

            @livewire('mahasiswa.simulation.satker-detail-prov-table', ['simulation_id' => $simulation->id, 'provinsi' => $satker->provinsi])
        @endif

        <div class="flex justify-between mt-2">
            <div class="flex items-center text-gray-400 text-sm mt-3 leading-tight">
                <x-badge.error text="Tidak Terpilih" /> bisa jadi dia terpilih di Satker yang lain. Untuk mengetahui dia
                terpilih dimana silahkan klik
                <x-button.icon.detail />
            </div>
            <x-anchor.secondary href="{{ route('user.simulasi.details', ['simulation' => $simulation->id]) }}"
                class="ml-2">
                Back
            </x-anchor.secondary>
        </div>
    </x-card.base>
</x-dashboard-layout>
