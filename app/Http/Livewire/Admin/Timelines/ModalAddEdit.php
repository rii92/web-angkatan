<?php

namespace App\Http\Livewire\Admin\Timelines;

use App\Constants\AppCalendarColor;
use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Timeline;
use LivewireUI\Modal\ModalComponent;

class ModalAddEdit extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::TIMELINE_MANAGEMENT;

    public $timeline;
    public $timeline_id;
    public $colors;

    public function rules()
    {
        return [
            'timeline.title' => 'required',
            'timeline.description' => 'nullable',
            'timeline.start_date' => 'required|date',
            'timeline.end_date' => 'date|after_or_equal:timeline.start_date',
            'timeline.color' => 'required',
        ];
    }


    public function mount()
    {
        $this->timeline = $this->timeline_id ? Timeline::find($this->timeline_id) : new Timeline();
        $this->colors = AppCalendarColor::all();
    }

    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm()
    {
        if (!$this->timeline->end_date) $this->timeline->end_date = $this->timeline->start_date;
        $this->validate();

        try {
            $this->timeline->save();

            $this->emit('success', "Success to add new timelines");
        } catch (\Exception $e) {
            // $this->emit('error', "Failed to add new timelines");
            $this->emit('error', $e->getMessage());
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'admin.timelines.table');
        }
    }


    public function render()
    {
        return view('admin.timelines.modal-add-edit');
    }
}
