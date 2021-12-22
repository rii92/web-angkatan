<?php

namespace App\Http\Livewire\Admin\Meetings;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\MeetingMember;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class ModalAddMember extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::MEETING_MANAGEMENT;

    public $meeting_id;

    public $search;
    public $users = [];

    public $role;

    public function rules()
    {
        return [
            'search' => 'required|exists:users,email',
        ];
    }

    public function selectResult($email)
    {
        $this->search = $email;
        $this->reset('users');
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
            $user_id = User::where('email', $this->search)->first()->id;
            MeetingMember::updateOrCreate(['user_id' => $user_id, 'meeting_id' => $this->meeting_id], []);

            $this->emit('success', "Success to add new member");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add new member");
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'admin.meetings.table-member');
        }
    }

    /**
     * handleBulk
     *
     * @return void
     */
    public function handleBulk()
    {
        $data = $this->validate(['role' => 'required']);

        try {
            $users = User::role($data['role'])->pluck('id');

            // IDK, it's good or not for bulk updating
            foreach ($users as $id) {
                MeetingMember::updateOrCreate(['user_id' => $id, 'meeting_id' => $this->meeting_id], []);
            }

            $this->emit('success', "Success to add new member from {$data['role']}");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add new member from {$data['role']}");
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'admin.meetings.table-member');
        }
    }

    public function render()
    {
        $search = '%' . $this->search . '%';

        $this->users = Str::of($this->search)->trim()->isNotEmpty()
            ? User::where('name', 'like', $search)->orWhere('email', 'like', $search)->limit(2)->get()
            : [];

        return view('admin.meetings.modal-add-member');
    }
}
