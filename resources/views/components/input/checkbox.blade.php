<div class="inline-flex items-center">
    <input {{ $attributes->merge(['type' => 'checkbox', 'class' => 'form-checkbox rounded']) }} />
    @isset($text)
        <span class="ml-2 font-medium text-sm text-gray-700 capitalize">{{ $text }} </span>
    @endisset
</div>
