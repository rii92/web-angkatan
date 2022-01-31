<x-card.form>
    <x-slot name="title">
        {{ __('Account Setting') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update Your Email Notification Setting') }}
    </x-slot>

    <form wire:submit.prevent="handleForm">
        <x-input.wrapper>
            <x-input.checkbox id="details.setting_send_email_accept_konsultasi"
                wire:model.defer="details.setting_send_email_accept_konsultasi"
                text="Kirim Email Ketika Konsultasi Diterima/Ditolak" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="details.setting_send_email_reply_konsultasi"
                value="{{ __('Balasan Konsultasi (Jam)') }}" />
            <x-input.text id="details.setting_send_email_reply_konsultasi"
                wire:model.defer="details.setting_send_email_reply_konsultasi" type="number" min="0" />
            <x-input.caption class="mt-1">Jika bernilai "3" maka ketika konselor menjawab pesanmu lebih dari 3
                jam maka kamu akan
                dikirimkam email notifikasi. Isikan "0" jika tidak ingin mengaktifkan fitur ini</x-input.caption>
            <x-input.error for="details.setting_send_email_reply_konsultasi" />
        </x-input.wrapper>


        <div class="flex justify-end mt-6 items-center">
            <span class="mr-3 text-sm" wire:loading wire:target="handleForm">Saving...</span>

            <x-button.black type="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button.black>
        </div>
    </form>
</x-card.form>
