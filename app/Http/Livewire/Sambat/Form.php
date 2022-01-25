<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use App\Models\SambatImage;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Form extends Component
{
    public $tag, $description, $sambat_id, $sambat;
    public $is_anonim = 0;

    protected $listeners = ['submitForm' => 'handleForm'];

    protected $rules = [
        'is_anonim' => 'required|boolean',
    ];

    public function mount()
    {
        $this->sambat = $this->sambat_id ? Sambat::find($this->sambat_id) : new Sambat();
    }

    public function handleForm($description)
    {
        $this->sambat->description = $description;

        $this->validate();
        try {
            $tag_create = Tag::firstOrCreate([
                'name' => $this->tag
            ]);
            $tag = Tag::find([$tag_create->id]);
            if($this->sambat_id) $this->sambat->tags()->detach($tag);
    
            $this->sambat->user_id = Auth::user()->id;
            $this->sambat->is_anonim = $this->is_anonim;
    
            $this->sambat->save();
            $this->sambat->tags()->attach($tag);

            if ($this->sambat_id) return $this->emit('success', "Sambatanmu berhasil diubah!");
            return $this->emit('success', "Sambatanmu berhasil dibuat!");

        } catch (\Exception $e) {
            $this->emit('error', "Maaf, sambatanmu gagal dibuat");
        }
    }

    public function render()
    {
        return view('sambat.form');
    }
}
