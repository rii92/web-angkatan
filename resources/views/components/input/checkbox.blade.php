<div class="inline-flex items-center">
    <input {{ $attributes->merge(['type' => 'checkbox', 'class' => 'form-checkbox rounded']) }} />
    @isset($text)
        <x-input.label class="ml-2" for="{{ $attributes->get('id') }}" value="{{ $text }}" />
    @endisset
</div>
