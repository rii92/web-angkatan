<?php

namespace App\Http\Livewire\Mahasiswa\Form;

use App\Constants\AppMeetings;
use App\Models\MeetingMember;
use Livewire\Component;

class Meeting extends Component
{

    public $meeting_id;
    public $meetingMember;

    protected $rules = [
        'meetingMember.attend_at' => 'required',
        'meetingMember.notes' => 'nullable',
    ];

    public function mount()
    {
        $this->meetingMember = MeetingMember::where(['meeting_id' => $this->meeting_id, 'user_id' => auth()->id()])->firstOrFail();
    }

    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm()
    {
        $this->validate();

        try {
            $this->meetingMember->status = AppMeetings::PRESENT;
            $this->meetingMember->save();
            $this->emit('success', "Yeey, your response has been recorded");
        } catch (\Exception $e) {
            $this->emit('error', "Somethings wrong, I can feel it");
        }
    }

    public function render()
    {
        return view('mahasiswa.forms.meeting-form');
    }
}
