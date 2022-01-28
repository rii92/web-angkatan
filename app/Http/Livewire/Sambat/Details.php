<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class Details extends ModalComponent
{
    use WithPagination;

    private const COMMENT_PAGINATE = 2;

    public $sambat_id;
    public Sambat $sambat;

    public function mount()
    {
        $this->sambat = Sambat::where('id', $this->sambat_id)->first();
    }

    public function deleteComments($comment_id)
    {
        $this->emit('success', "TODO: delete comment with id:{$comment_id}");
    }

    public function render()
    {
        return view('sambat.details', [
            'comments' => SambatComment::where('sambat_id', $this->sambat_id)
                ->orderBy('created_at')
                ->paginate(self::COMMENT_PAGINATE),
        ]);
    }
}
