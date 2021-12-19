<div class="m-auto max-w-5xl">
    <div class="lg:grid lg:grid-cols-3 lg:gap-6 mx-2 my-2" {{ $attributes }}>
        {{-- title --}}
        <div class="lg:col-span-1 flex justify-between">
            <div class="px-4 md:px-0">
                <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $description }}
                </p>
            </div>
        </div>
    
        {{-- content --}}
        <div class="mt-5 lg:mt-0 lg:col-span-2">
            <div class="px-4 py-5 md:p-6 bg-white shadow md:rounded-md text-gray-800">
                {{ $slot }}
            </div>
        </div>
    </div>
    
</div>