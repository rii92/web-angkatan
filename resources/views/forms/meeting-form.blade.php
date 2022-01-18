<div>
    @if (!($meetingMember->status == AppMeetings::PRESENT))
        <form wire:submit.prevent="handleForm">
            <x-input.wrapper>
                <x-input.label for="meetingMember.attend_at" value="{{ __('Time') }}" />
                <x-input.text wire:model.defer="meetingMember.attend_at" id="attend_at" type="time" />
                <x-input.error for="meetingMember.attend_at" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="meetingMember.notes" value="{{ __('Your notes for this meeting') }}" />
                <x-input.textarea wire:model.defer="meetingMember.notes" id="notes" rows="3" />
                <x-input.error for="meetingMember.notes" />
            </x-input.wrapper>

            <div class="flex justify-end">
                <x-button.black type="submit">
                    Submit
                </x-button.black>
            </div>
        </form>
    @else
        <div class="text-sm text-green-700">Sank You, Your response has been recorded</div>
    @endif
</div>
