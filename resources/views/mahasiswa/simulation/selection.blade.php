<div class="flex flex-col md:flex-row mb-4">
    <x-card.base class="flex-1">
        <p>Todo: Informasi mekanisme simulasi</p>
        <p>Todo: Pesan-pesan sebelum memilih penempatan</p>
    </x-card.base>
    <x-card.base class="flex-1">
        <div class="flex justify-between">
            <div>{{ $user->name }}</div>
            <div>{{ $session->start_time }} - {{ $session->end_time }} </div>
            <div>{{ $user->details['rank_' . $BASED_ON] }}  / {{ $max_rank }}</div>
        </div>
    </x-card.base>
</div>
