<?php

namespace App\Http\Livewire\Admin\Announcement;

use App\Constants\AppPermissions;
use Livewire\Component;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Announcement;

class Form extends Component
{
    use GuardsAgainstAccess;
    private $permissionGuard = AppPermissions::ANNOUNCEMENT_MANAGEMENT;

    public $announcement;
    public $announcement_id;
    public $title;
    protected $listeners = ['submitForm' => 'handleForm'];

    public function rules()
    {
        return [
            'announcement.title' => 'required',
            'announcement.content' => 'required',
            'announcement.published_at' => 'nullable|date',
        ];
    }

    public function mount()
    {
        $this->announcement = $this->announcement_id ? Announcement::find($this->announcement_id) : new Announcement();
        $this->title = $this->announcement_id ? "Edit Announcement" : "Add Announcement";
    }

    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm($content)
    {
        $this->announcement->content = $content;
        $this->validate();

        try {
            $this->announcement->published_at = $this->announcement->published_at ?? now();
            $this->announcement->save();

            if ($this->announcement_id) return $this->emit('success', "Changes Saved Successfully");
            return redirect()->route('admin.announcement.table')->with('message', 'Success to add new announcement');
        } catch (\Exception $e) {
            $this->emit('error', "Somethings Wrong, I can feel it");
        }
    }

    public function render()
    {
        return view('admin.announcement.form')
            ->layout('layouts.dashboard', ['title' => "Announcement"]);
    }
}
