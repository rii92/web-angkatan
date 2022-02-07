<?php

namespace App\Http\Livewire\Guest\Konsultasi;

use App\Models\Konsul;
use Livewire\Component;

class Detail extends Component
{

    public Konsul $konsul;
    public $konsul_id;

    public function mount($slug)
    {
        try {
            $this->konsul = Konsul::with(['user', 'userdetails'])
                ->publish()
                ->where('slug', $slug)
                ->first();
        } catch (\Throwable $th) {
            abort(404);
        }
    }


    public function render()
    {
        return view('guest.konsultasi.detail')
            ->layout('layouts.app', ['title' => 'Konsultasi']);
    }
}
