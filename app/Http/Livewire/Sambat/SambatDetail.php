<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class SambatDetail extends ModalComponent
{
    public $sambat_id, $description;
    public Sambat $sambat;

    use WithPagination;

    public function mount()
    {
        $this->sambat = Sambat::where('id', $this->sambat_id)->first();
    }

    public function render()
    {
        return view('sambat.sambat-detail',[
            'sambat_comment' => DB::table('sambat_comments')
                                ->join('users', 'sambat_comments.user_id', '=', 'users.id')
                                ->select('sambat_comments.*', 'users.name')
                                ->where('sambat_id', $this->sambat_id)
                                ->orderBy('created_at')
                                ->paginate(2)
        ]);
    }

    private function resetCommentForm(){
        $this->description = '';
    }

    public function store()
    {
        $this->validate([
            'description' => 'required',
        ]);

        SambatComment::updateOrCreate(['id' => $this->sambat_id], [
            'description' => $this->desc,
        ]);

        $this->resetCommentForm();
    }
} 