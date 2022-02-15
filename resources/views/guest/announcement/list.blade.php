<div>
    @if (count($announcements) == 0)
        <div class="text-center font-semibold font-poppins text-xl text-gray-600 italic mt-5">Belum tersedia informasi
            terbaru ...</div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-5 fadeInUp animate">
            @foreach ($announcements as $announcement)
                <a href=" {{ route('announcement.details', $announcement->id) }}">
                    <x-card.announcement-items>
                        <x-slot name="title">{{ $announcement->title }}</x-slot>
                        <x-slot name="content">{!! Str::limit(strip_tags(Str::markdown($announcement->content)), 130, '...') !!}</x-slot>
                        <x-slot name="published">{{ $announcement->published_at->format('M j, Y . h:i A') }}</x-slot>
                    </x-card.announcement-items>
                </a>
            @endforeach
        </div>
        {{ $announcements->links() }}
    @endif
</div>
