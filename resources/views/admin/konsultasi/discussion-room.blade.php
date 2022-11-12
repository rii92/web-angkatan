<x-konsultasi.wrapper-room>
    <x-slot name="header">
        <h1 class="text-2xl">
            {{ $konsul->title }}
            <x-konsultasi.status status="{{ $konsul->status }}" class="ml-1" />
            <x-button.icon.activity title="Riwayat Konsultasi" class="inline-block ml-0"
                onclick="Livewire.emit('openModal', 'activity.konsultasi', {{ json_encode(['konsul_id' => $konsul->id]) }})" />
        </h1>
        <p class="mt-2 text-sm">
            <span>{{ $konsul->name }}</span>
            @if ($konsul->is_anonim)
                <span>(Jurusan {{ $konsul->userdetails->jurusan_short ?? '' }})</span>
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
        <x-konsultasi.chat-message message="{!! $konsul->description !!}" :time="$konsul->created_at"
            isLeft="{{ true }}" />

        @foreach ($konsul->chats as $chat)
            <x-konsultasi.chat :chat="$chat" route="admin"
                canDelete="{{ $konsul->status == AppKonsul::STATUS_PROGRESS }}" />
        @endforeach

        @if ($konsul->status == AppKonsul::STATUS_REJECT)
            <x-konsultasi.chat-message message="{!! $konsul->note !!}" :time="$konsul->acc_rej_at"
                isLeft="{{ false }}" />
        @endif
    </x-slot>

    <x-slot name="footer">
        @if ($konsul->status == AppKonsul::STATUS_WAIT)
            @livewire('admin.konsultasi.form-acceptance', ['konsul' => $konsul->id])
        @endif

        @if ($konsul->status == AppKonsul::STATUS_REJECT)
            <div class="mt-3 mb-1 flex justify-end items-center">
                <x-anchor.secondary href="{{ route('admin.konsultasi.' . $konsul->category . '.table') }}">
                    Back
                </x-anchor.secondary>
            </div>
        @endif

        @if ($konsul->status == AppKonsul::STATUS_PROGRESS)
            <div class="mt-3 mb-1 flex justify-between items-center">
                <div class="flex">
                    <x-icons.refresh
                        class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180"
                        wire:click="$refresh" />
                    @livewire('konsultasi.upload-image', ['konsul' => $konsul->id, 'route' => 'admin'])
                </div>
                <x-anchor.error wire:click="closeRoom">
                    Akhiri Konsultasi
                </x-anchor.error>
            </div>
            @livewire('konsultasi.input-chat', ['konsul' => $konsul->id, 'route' => 'admin'])
        @endif

        @if ($konsul->status == AppKonsul::STATUS_DONE)
            @if (!$konsul->is_publish)
                <div class="mt-3 mb-1 sm:flex sm:justify-end sm:items-center">
                    <p class="text-gray-500 text-xs sm:mr-3">
                        Konsultasi ini selesai pada {{ $konsul->done_at->format('d M H:i:s') }}.
                        @if ($this->konsul->acc_publish_admin)
                            Kamu menyetujui untuk mempublish konsultasi ini. Konsultasi baru akan ke publish jika
                            penanya juga menyetujuinya
                        @else
                            @if ($this->konsul->acc_publish_user)
                                Penanya sudah setuju untuk mempublish ini. Apakah kamu setuju juga untuk mempublishnya?
                            @else
                                Kamu belum menyetujui untuk mempublish konsultasi ini. Apakah kamu menyetujui untuk
                                dipublish?
                            @endif
                        @endif
                    </p>
                    <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                        @if ($this->konsul->acc_publish_admin)
                            <x-anchor.error wire:click="unpublish">
                                Reject to Publish
                            </x-anchor.error>

                            <x-anchor.secondary
                                href="{{ route('admin.konsultasi.' . $konsul->category . '.table') }}"
                                class="ml-2">
                                Back
                            </x-anchor.secondary>
                        @else
                            <x-anchor.success wire:click="publish">
                                Accept to Publish
                            </x-anchor.success>

                            <x-anchor.secondary wire:click="openRoom" class="ml-2">
                                Buka Lagi Konsultasi
                            </x-anchor.secondary>
                        @endif
                    </div>
                </div>
            @else
                <div class="mt-3 mb-1 sm:flex sm:justify-between sm:items-center">
                    <p class="text-gray-500 text-xs sm:mr-3">
                        Konsultasi ini sudah dipublish <x-link class="underline"
                            href="{{ route('konsultasi.detail', ['slug' => $konsul->slug]) }}">disini</x-link> oleh
                        penanya pada
                        {{ $konsul->published_at->format('d M H:i:s') }}
                    </p>

                    <div class="flex">
                        <x-anchor.error wire:click="unpublish">
                            Unpublish
                        </x-anchor.error>

                        <x-anchor.secondary href="{{ route('admin.konsultasi.' . $konsul->category . '.table') }}"
                            class="ml-2">
                            Back
                        </x-anchor.secondary>
                    </div>


                </div>
            @endif
        @endif
    </x-slot>
</x-konsultasi.wrapper-room>
