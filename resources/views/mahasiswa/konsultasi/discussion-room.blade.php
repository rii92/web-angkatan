<x-konsultasi.wrapper-room>
    <x-slot name="header">
        <h1 class="text-2xl">
            {{ $konsul->title }}
            <x-konsultasi.status status="{{ $konsul->status }}" class="ml-1" />
        </h1>
        <p class="text-sm">
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
            createdAt="{{ $konsul->created_at->format('d M H:i') }}"
            isRead="{{ $konsul->status != AppKonsul::STATUS_WAIT }}" isLeft="{{ false }}"
            canDelete="{{ false }}" />

        @if ($konsul->status == AppKonsul::STATUS_REJECT)
            <x-konsultasi.chat description="{!! $konsul->note !!}"
                createdAt="{{ $konsul->updated_at->format('d M H:i') }}" isRead="{{ false }}"
                isLeft="{{ true }}" />
        @endif
    </x-slot>

    <x-slot name="footer">
        @if ($konsul->status == AppKonsul::STATUS_WAIT)
            <div class="flex justify-between items-center mt-3">
                <p class="text-sm text-gray-500 mr-3">Kamu baru bisa memulai diskusi ketika konseler sudah menerima
                    pengajuan
                    konsultasimu</p>

                <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}">
                    Back
                </x-anchor.secondary>
            </div>
        @endif
    </x-slot>
</x-konsultasi.wrapper-room>
