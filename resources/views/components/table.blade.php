@props(['theads', 'overflow' => 'true', 'maxHeight' => ''])

<div {{ $attributes->merge(['class' => 'mb-5']) }}>
    <div class="overflow-auto {{ $maxHeight }}">
        <table class="{{ $overflow == true ? 'min-w-max' : ''  }} w-full table-auto">
            <thead>
                <tr class=" bg-blueGray-50 text-gray-600 uppercase font-sans text-xs leading-normal border-b">
                    @foreach ($theads as $thead)
                    <th class="py-3 px-6 text-center">{{ $thead }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-base-blue-300 text-sm font-medium">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
