<div>
    <x-input.text type="file" wire:model="image" id="image-uploader" class="hidden" />
    <div class="flex items-center">
        <label for="image-uploader" class="cursor-pointer">
            <x-icons.image class="mx-2" />
        </label>
        <x-input.error for="image" />
        <p class="text-xs text-gray-400" wire:loading>Upload gambar ..</p>
    </div>
</div>
