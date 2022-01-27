@props(['isPublish' => 0, 'isAnonim', 'withAnonim' => true])

@if ($isPublish)
    <x-badge.success text="Publish" />
@endif

@if ($isAnonim && $withAnonim)
    <x-badge.secondary text="Anonim" />
@endif
