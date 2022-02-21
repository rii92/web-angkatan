<x-konsultasi.wrapper-room>
    <x-slot name="header">
        <h1 class="text-2xl flex items-center">
            <span>{{ $konsul->title }}</span>
            <div class="flex mb-2">
                <x-konsultasi.status status="{{ $konsul->status }}" class="ml-1" />
            </div>
            <div>
                <x-button.icon.activity title="Riwayat Konsultasi" class="inline-block ml-0 mt-2"
                    onclick="Livewire.emit('openModal', 'activity.konsultasi', {{ json_encode(['konsul_id' => $konsul->id]) }})" />
            </div>
        </h1>
        <p class="text-sm">
            @foreach ($konsul->tags as $tag)
                <x-badge.success text="{{ $tag->name }}" class="mr-0" />
            @endforeach
        </p>
        <p class="italic text-xs text-gray-600">
            Ditanyakan pada {{ $konsul->created_at->format('d M Y H:i:s') }}
        </p>
    </x-slot>

    <x-slot name="chats">
        <x-konsultasi.chat-message message="{!! $konsul->description !!}" :time="$konsul->created_at"
            isLeft="{{ false }}" isRead="{{ $konsul->status != AppKonsul::STATUS_WAIT }}" />

        @foreach ($konsul->chats as $chat)
            <x-konsultasi.chat :chat="$chat" route="mahasiswa"
                canDelete="{{ $konsul->status == AppKonsul::STATUS_PROGRESS }}" />
        @endforeach

        @if ($konsul->status == AppKonsul::STATUS_REJECT)
            <x-konsultasi.chat-message message="{!! $konsul->note !!}" :time="$konsul->acc_rej_at"
                isLeft="{{ true }}" />
        @endif
    </x-slot>

    <x-slot name="footer">
        <div class="mt-3 mb-1 sm:flex sm:justify-between sm:items-center">
            @if ($konsul->status == AppKonsul::STATUS_WAIT)
                <p class="text-sm text-gray-500 sm:mr-3">
                    Kamu baru bisa memulai diskusi ketika konselor sudah menerima pengajuan konsultasimu
                </p>
                <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}">
                    Back
                </x-anchor.secondary>
            @endif

            @if ($konsul->status == AppKonsul::STATUS_REJECT)
                <p class="text-gray-500 text-xs sm:mr-3">Mohon maaf, pengajuan konsultasimu tidak diterima</p>
                <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                    <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}">
                        Back
                    </x-anchor.secondary>
                </div>
            @endif

            @if ($konsul->status == AppKonsul::STATUS_PROGRESS)
                <div class="flex">
                    <x-icons.refresh
                        class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180"
                        wire:click="$refresh" />
                    @livewire('konsultasi.upload-image', ['konsul' => $konsul->id, 'route' => 'user'])
                </div>
                <x-anchor.error wire:click="closeRoom">
                    Akhiri Konsultasi
                </x-anchor.error>
            @endif

            @if ($konsul->status == AppKonsul::STATUS_DONE)
                @if (!$konsul->is_publish)
                    <p class="text-gray-500 text-xs sm:mr-3">
                        Konsultasi selesai pada {{ $konsul->done_at->format('d M H:i:s') }}.
                        @if ($konsul->acc_publish_user)
                            Kamu menyetujui untuk mempublish konsultasi ini. Konsultasi baru akan ke publish jika
                            admin juga menyetujuinya
                        @else
                            @if ($this->konsul->acc_publish_admin)
                                Admin sudah setuju untuk mempublish ini.
                            @endif

                            Konsultasi yang sudah dipublish akan bisa dilihat oleh siapa saja.
                            Jika kamu bertanya sebagai anonim maka namamu tetap tidak akan ditampilkan.
                            Jika menurut kamu konsultasi ini sangat bermanfaat dan bisa membantu orang lain
                            maka sangat disarankan untuk mempublishnya
                        @endif


                    </p>
                    <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                        @if ($this->konsul->acc_publish_user)
                            <x-anchor.error wire:click="unpublishKonsultasi">
                                Reject to Publish
                            </x-anchor.error>
                            <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}"
                                class="ml-2">
                                Back
                            </x-anchor.secondary>
                        @else
                            <x-anchor.success wire:click="publishKonsultasi">
                                Accept to Publish
                            </x-anchor.success>
                            {{-- idk if I use wire:click in one case it doest'n work --}}
                            <x-anchor.secondary onclick="Livewire.emit('openRoom')" class="ml-2">
                                Buka Lagi Konsultasi
                            </x-anchor.secondary>
                        @endif

                    </div>
                @else
                    <p class="text-gray-500 text-xs sm:mr-3">Konsultasimu sudah dipublish
                        <x-link class="underline"
                            href="{{ route('konsultasi.detail', ['slug' => $konsul->slug]) }}">disini</x-link> pada
                        {{ $konsul->published_at->format('d M H:i:s') }}. Kamu bebas kapan saja untuk
                        meng-unpublishkannya kembali
                    </p>
                    <div class="md:ml-3 md:mt-0 mt-2 flex items-center whitespace-nowrap justify-end">
                        <x-anchor.error wire:click="unpublishKonsultasi">
                            Unpublish
                        </x-anchor.error>
                        <x-anchor.secondary href="{{ route('user.konsultasi.' . $konsul->category . '.table') }}"
                            class="ml-2">
                            Back
                        </x-anchor.secondary>
                    </div>
                @endif
            @endif
        </div>

        @if ($konsul->status == AppKonsul::STATUS_PROGRESS)
            @livewire('konsultasi.input-chat', ['konsul' => $konsul->id, 'route' => 'user'])
        @endif
    </x-slot>
</x-konsultasi.wrapper-room>
