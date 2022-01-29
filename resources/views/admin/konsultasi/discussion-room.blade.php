<x-konsultasi.wrapper-room>
    <x-slot name="header">
        <h1 class="text-2xl">
            {{ $konsul->title }}
            <x-konsultasi.status status="{{ $konsul->status }}" class="ml-1" />
        </h1>
        <p class="mt-2 text-sm">
            <span>{{ $konsul->name }}</span>
            @if ($konsul->is_anonim)
                <span>(Jurusan {{ substr($konsul->userdetails->kelas, 1, 2) ?? '' }})</span>
            @else
                <span>({{ $konsul->userdetails->nim ?? '' }}/{{ $konsul->userdetails->kelas ?? '' }})</span>
            @endif

            @foreach ($konsul->tags as $tag)
                <x-badge.success text="{{ $tag->name }}" class="mr-0" />
            @endforeach
        </p>
        <p class="italic text-xs text-gray-600">Ditanyakan pada
            {{ $konsul->created_at->format('d M Y H:i:s') }}
        </p>
    </x-slot>

    <x-slot name="chats">
        <x-konsultasi.chat description="{!! $konsul->description !!}"
            createdAt="{{ $konsul->created_at->format('d M H:i') }}" isRead="{{ false }}"
            isLeft="{{ true }}" />

        @if ($konsul->status == AppKonsul::STATUS_REJECT)
            <x-konsultasi.chat description="{!! $konsul->note !!}"
                createdAt="{{ $konsul->updated_at->format('d M H:i') }}" isRead="{{ false }}"
                isLeft="{{ false }}" canDelete="{{ false }}" />
        @endif
    </x-slot>

    <x-slot name="footer">
        @if ($konsul->status == AppKonsul::STATUS_WAIT)
            @livewire('admin.konsultasi.form-acceptance', ['konsul' => $konsul->id])
        @endif
    </x-slot>
</x-konsultasi.wrapper-room>
