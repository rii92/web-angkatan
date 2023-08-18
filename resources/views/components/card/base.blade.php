<div class="my-2 mx-2 mb-4 flex-1">
    <div class="px-4 py-5 sm:p-6 bg-white sm:rounded-lg shadow-lg h-full">
        <!-- header -->
        <div
            class="flex justify-between items-center px-4 sm:px-0 {{ isset($title) || isset($aside) ? 'border-b mb-5' : '' }}">
            @isset($title)
                <h4 class="mb-2 flex-1 text-lg font-bold text-gray-700 dark:text-gray-300 capitalize">
                    {!! $title !!}
                </h4>
            @endisset
            @isset($aside)
                <div class="mb-2 ">
                    {{ $aside }}
                </div>
            @endisset
        </div>
        <!-- body -->
        <div {{ $attributes->merge(['class' => 'text-gray-800']) }}>
            {{ $slot }}
        </div>
    </div>
</div>
