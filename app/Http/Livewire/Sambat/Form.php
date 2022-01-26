<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Image;
use App\Models\Sambat;
use App\Models\SambatImage;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $image;
    public $tag, $description, $sambat_id, $sambat;
    public $is_anonim = 0;

    protected $listeners = ['submitForm' => 'handleForm'];

    public function mount()
    {
        $this->sambat = $this->sambat_id ? Sambat::find($this->sambat_id) : new Sambat();
    }

    public function handleForm($description)
    {
        $this->sambat->description = $description;

        $this->validate([
            'image' => 'image|max:1024',
        ]);

        $url = $this->image->store('image');

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
            
            $pict = new Image();
            $pict->url = $url;
            $pict->imageable_id = $this->sambat->id;
            $pict->imageable_type = Sambat::class;
            $pict->save();
            

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
