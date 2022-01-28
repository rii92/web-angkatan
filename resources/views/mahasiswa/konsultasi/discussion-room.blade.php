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

        @foreach ($konsul->chats as $chat)
            <x-konsultasi.chat description="{!! $chat->pivot->chat !!}"
                createdAt="{{ $chat->pivot->created_at->format('d M H:i') }}"
                isRead="{{ $chat->pivot->is_seen && !$chat->pivot->is_admin }}"
                isLeft="{{ $chat->pivot->is_admin }}" canDelete="{{ !$chat->pivot->is_admin }}"
                chatId="{{ $chat->pivot->id }}" route="mahasiswa" />
        @endforeach

        @if ($konsul->status == AppKonsul::STATUS_REJECT)
            <x-konsultasi.chat description="{!! $konsul->note !!}"
                createdAt="{{ $konsul->acc_rej_at->format('d M H:i') }}" isRead="{{ false }}"
                isLeft="{{ true }}" />
        @endif
    </x-slot>

    <x-slot name="footer">
        <div class="mt-3 mb-1 md:flex justify-between items-center">
            @if ($konsul->status == AppKonsul::STATUS_WAIT)
                <p class="text-sm text-gray-500 mr-3">Kamu baru bisa memulai diskusi ketika konseler sudah menerima
                    pengajuan
                    konsultasimu</p>
                <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}">
                    Back
                </x-anchor.secondary>
            @endif

            @if ($konsul->status == AppKonsul::STATUS_REJECT)
                <p class="text-gray-500 text-xs">Mohon maaf, pengajuan konsultasimu tidak diterima</p>
                <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                    <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}">
                        Back
                    </x-anchor.secondary>
                </div>
            @endif

            @if ($konsul->status == AppKonsul::STATUS_PROGRESS)
                <x-icons.refresh
                    class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180"
                    wire:click="$refresh" />
                <x-anchor.error wire:click="closeRoom">
                    Akhiri Konsultasi
                </x-anchor.error>
            @endif

            @if ($konsul->status == AppKonsul::STATUS_DONE)
                @if (!$konsul->is_publish)
                    <p class="text-gray-500 text-xs">Konsultasi selesai pada
                        {{ $konsul->done_at->format('d M H:i:s') }}. Konsultasi yang sudah dipublish akan bisa
                        dilihat
                        oleh siapa
                        saja.
                        Jika kamu bertanya sebagai
                        anonim maka namamu tetap tidak akan ditampilkan. Jika menurut kamu konsultasi ini sangat
                        bermanfaat
                        dan bisa membantu orang lain maka sangat disarankan untuk mempublishnya</p>
                    <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                        <x-anchor.success wire:click="publishKonsultasi">
                            Publish
                        </x-anchor.success>

                        <x-anchor.secondary wire:click="openRoom" class="ml-2">
                            Buka Lagi Konsultasi
                        </x-anchor.secondary>
                    </div>
                @else
                    <p class="text-gray-500 text-xs">Konsultasimu sudah dipublish pada
                        {{ $konsul->published_at->format('d M H:i:s') }}. Kamu bebas kapan saja untuk
                        meng-unpublishkannya kembali</p>
                    <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                        <x-anchor.error wire:click="unpublishKonsultasi">
                            Unpublish
                        </x-anchor.error>
                    </div>
                @endif
            @endif
        </div>

        @if ($konsul->status == AppKonsul::STATUS_PROGRESS)
            @livewire('konsultasi.input-chat', ['konsul' => $konsul->id, 'route' => 'user'])
        @endif
    </x-slot>
</x-konsultasi.wrapper-room>
