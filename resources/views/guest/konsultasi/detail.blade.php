<x-landingpage.wrapper title="Konsultasi">
    @php
        $photoUser = $konsul->is_anonim ? url('img/user-avatar.svg') : $konsul->user->profile_photo_url;
        $nameUser = $konsul->is_anonim ? 'Anonim ' . $konsul->userdetails->jurusan_short : $konsul->user->name;

        $photoAdmin = 'https://ui-avatars.com/api/?name=Admin&color=7F9CF5&background=EBF4FF';
    @endphp

    <div class="max-w-5xl mx-auto">
        <header>
            <h2 class="md:text-3xl text-xl">{{ $konsul->title }}</h2>
            <div>
                <x-konsultasi.category category="{{ $konsul->category }}" />
                <span class="text-sm text-gray-700 italic">Ditanyakan oleh
                    <b>
                        {{ $nameUser }}
                        @if ($konsul->is_anonim)
                            (Jurusan {{ $konsul->userdetails->jurusan_short }})
                        @else
                            ({{ $konsul->userdetails->nim }}/{{ $konsul->userdetails->kelas }})
                        @endif
                    </b>
                    pada
                    {{ $konsul->created_at->format('d M Y H:i') }}. Dipublish pada
                    {{ $konsul->published_at->format('d M Y H:i') }}</span>
            </div>
            <div>
                @foreach ($konsul->tags as $tag)
                    <x-badge.success text="{{ $tag->name }}" class="mr-0" />
                @endforeach
            </div>
            <hr class="mt-4">
        </header>

        <main class="mt-8" id="room">
            <ol class="relative border-l-2 border-gray-300 dark:border-gray-700 sm:mr-3 mr-1 sm:ml-20 ml-7">
                <x-konsultasi.chat-guest photo="{!! $photoUser !!}" name="{{ $nameUser }}"
                    :time="$konsul->created_at" text="{!! $konsul->description !!}"
                    type="{{ AppKonsul::TYPE_CHAT_TEXT }}" />

                @foreach ($konsul->chats as $chat)
                    <x-konsultasi.chat-guest photo="{!! $chat->is_admin ? $photoAdmin : $photoUser !!}"
                        name="{{ $chat->is_admin ? $chat->userdetails->admin_name : $nameUser }}"
                        :time="$chat->created_at" text="{!! $chat->chat !!}" type="{{ $chat->type }}" />
                @endforeach
            </ol>
        </main>
    </div>

    @push('scripts')
        <script src="{{ mix('js/viewer.js') }}" defer></script>
        <script>
            window.addEventListener("DOMContentLoaded", function() {
                new Viewer(document.getElementById('room'), {
                    inline: false,
                    zoomRatio: 0.2,
                    filter: (image) => image.classList.contains('image-chat')
                });
            }, false);
        </script>
    @endpush
</x-landingpage.wrapper>
