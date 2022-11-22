<x-card.base class="flex-1">
    <div class="flex justify-between">
        <div>{{ $formation->user->name }}</div>
        <div>{{ $formation->session }} </div>
        <div>{{ $formation->user_rank }} / {{ $max_rank }}</div>
    </div>
</x-card.base>
