<div class="flex justify-center">
    <x-konsultasi.status status="{{ $konsul->status }}" />
    <x-konsultasi.visibility isPublish="{{ $konsul->is_publish }}" isAnonim="{{ $konsul->is_anonim }}"
        withAnonim="{{ false }}" />
</div>
