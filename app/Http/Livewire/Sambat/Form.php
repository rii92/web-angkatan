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
    use WithFileUploads;

    public $tag, $description, $sambat_id, $sambat, $image;
    public $is_anonim = 0;

    protected $listeners = ['submitForm' => 'handleForm'];

    public function rules()
    {
        return [
            'description' => 'required',
            'is_anonim' => 'required',
            'created_at' => 'nullable|date',
            'sambat.images' => 'image|max:1024'
        ];
    }

    public function mount()
    {
        $this->sambat = $this->sambat_id ? Sambat::find($this->sambat_id) : new Sambat();
    }

    public function render()
    {
        return view('sambat.form');
    }

    public function handleForm($description)
    {
        $this->sambat->description = $description;

        $imageName = '';

        if ($this->image) {
            $imageName = Str::slug('sambat-')
                . '-'
                . uniqid()
                . '.' . $this->image->getClientOriginalExtension();

            $this->image->storeAs('sambat-images', $imageName, 'local');
        }

        $this->validate();
        try {
            $tag_create = Tag::firstOrCreate([
                'name' => $this->tag
            ]);
    
            $this->sambat->user_id = Auth::user()->id;
            $this->sambat->is_anonim = $this->is_anonim;
            $this->sambat->created_at = $this->sambat->created_at ?? now();
    
            $this->sambat->save();
            $tag = Tag::find([$tag_create->id]);
            $this->sambat->tags()->attach($tag);

            if ($this->sambat_id) return $this->emit('success', "Sambatanmu berhasil diubah!");
            return redirect()->route('sambat')->with('message', 'Sambatanmu berhasil dibuat!');

            
        } catch (\Exception $e) {
            $this->emit('error', "Maaf, sambatanmu gagal dibuat" . $e);
        }
    }
}
