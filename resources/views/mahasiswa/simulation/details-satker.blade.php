<x-dashboard-layout title="{{ $simulation->title }}">
    <x-card.base>

        @if ($type == 'kab')
            <h1 class="font-bold mb-2">{{ $satker->full_name }} - {{ $satker->location->provinsi }}</h1>
        @else
            <h1 class="font-bold mb-2">Provinsi {{ $satker->provinsi }}</h1>
        @endif

        <div class="flex flex-col mb-2">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-gray-50">
                                <tr>
                                    @foreach (AppSimulation::BASED_ON() as $key => $value)
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 border"
                                            colspan="5">
                                            {{ strtoupper($key) }}
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach (AppSimulation::BASED_ON() as $key => $value)
                                        @foreach (['Formasi', 'Final', 'P1', 'P2', 'P3'] as $c)
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-2 py-2 border {{ in_array($c, ['Formasi', 'Final']) ? 'bg-yellow-100' : '' }}">
                                                {{ $c }}
                                            </th>
                                        @endforeach
                                    @endforeach
                                </tr>
                            </thead class="border-b">
                            <tbody>
                                <tr class="bg-white border-b">
                                    @foreach (AppSimulation::BASED_ON() as $key => $value)
                                        @foreach ([$key, "formation_final_$key", "formation_1_$key", "formation_2_$key", "formation_3_$key"] as $key2)
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border">
                                                {{ $satker->{$key2} }}
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($type == 'kab')
            @livewire('mahasiswa.simulation.satker-detail-kab-table', ['simulation_id' => $simulation->id, 'satker_id' => $satker->id])
        @else
            @livewire('mahasiswa.simulation.satker-detail-prov-table', ['simulation_id' => $simulation->id, 'provinsi' => $satker->provinsi])
        @endif

        <div class="flex justify-end mt-2">
            <x-anchor.secondary href="{{ route('user.simulasi.details', ['simulation' => $simulation->id]) }}"
                class="ml-2">
                Back
            </x-anchor.secondary>
        </div>
    </x-card.base>
</x-dashboard-layout>
