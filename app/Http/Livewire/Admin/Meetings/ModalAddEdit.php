<?php

namespace App\Http\Livewire\Admin\Meetings;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Meeting;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class ModalAddEdit extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::MEETING_MANAGEMENT;

    public $meeting;
    public $meeting_id;

    public function rules()
    {
        return [
            'meeting.name' => 'required',
            'meeting.description' => 'nullable',
            'meeting.is_open' => 'required|boolean',
            'meeting.started_at' => 'required|date',
        ];
    }


    public function mount()
    {
        $this->meeting = $this->meeting_id ? Meeting::find($this->meeting_id) : new Meeting();
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
            if (!$this->meeting->token) $this->meeting->token = (string) Str::uuid();

            $this->meeting->save();

            $this->emit('success', "Success to add new meetings");
        } catch (\Exception $e) {
            // $this->emit('error', "Failed to add new meetings");
            $this->emit('error', $e->getMessage());
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'admin.meetings.table');
        }
    }


    public function render()
    {
        return view('admin.meetings.modal-add-edit');
    }
}
