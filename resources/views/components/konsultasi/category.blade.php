@switch($category)
    @case(AppKonsul::TYPE_AKADEMIK)
        <x-badge.primary text="{{ $category }}" class="mr-0 capitalize" />
    @break
    @case(AppKonsul::TYPE_UMUM)
        <x-badge.success text="{{ $category }}" class="mr-0 capitalize" />
    @break
@endswitch
