@props(['activity'])

@php
$note = $activity->pivot->note;
$name = $activity->pivot->icon == AppActivity::TYPE_PHOTO ? $activity->name : $activity->pivot->icon;

if ($activity->pivot->icon == AppActivity::TYPE_PHOTO) {
    $photo = $activity->profile_photo_url;
} else {
    if ($name == AppActivity::TYPE_ANONIM) {
        $photo = 'https://ui-avatars.com/api/?name=Anonim&color=7F9CF5&background=EBF4FF';
    } elseif ($name == AppActivity::TYPE_ADMIN) {
        $photo = 'https://ui-avatars.com/api/?name=Admin&color=7F9CF5&background=EBF4FF';
    }
}
@endphp

<li class="mb-5 ml-6">
    <span
        class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
        <img class="rounded-full shadow-lg" src="{!! $photo !!}" alt="{{ $name }}"
            title="{{ ucwords($name) }}" />
    </span>
    <div
        class="sm:py-3 px-3 pt-1 pb-2 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
        <div class="justify-between items-center sm:flex">
            <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0 whitespace-nowrap">
                {{ $activity->pivot->created_at->diffForHumans() }}
            </time>
            <div class="text-xs font-normal text-gray-500 lex dark:text-gray-300">
                {!! $activity->pivot->title !!}
            </div>
        </div>
        @if ($note)
            <div
                class="p-3 text-xs italic font-normal text-gray-500 bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 mt-2">
                {!! $note !!}</div>
        @endif
    </div>
</li>
