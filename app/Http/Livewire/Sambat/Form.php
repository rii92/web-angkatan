<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Image;
use App\Models\Sambat;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public Sambat $sambat;

    public $image, $tags;

    protected $listeners = [
        'submitForm' => 'handleForm'
    ];

    public function rules()
    {
        return [
            'sambat.description' => 'required',
            'sambat.is_anonim' => 'required|boolean',
            'sambat.user_id' => 'required',
            'image' => 'nullable|image|max:1024',
            'tags' => 'nullable|array',
            'tags.*' => 'required'
        ];
    }

    public function mount(Sambat $sambat)
    {
        $this->sambat = $sambat ?? new Sambat();
        $this->tags = $this->sambat->id ? $this->sambat->tags->pluck('name') : collect([]);
    }

    public function addTags()
    {
        try {
            $this->tags =  $this->tags->push('');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function removeTags($index)
    {
        try {
            $this->tags =  $this->tags->forget($index);
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function handleForm($description)
    {
        $this->sambat->description = $description;
        $this->sambat->user_id = Auth::user()->id;

        $this->validate();

        try {

            $this->sambat->save();

            // image
            if ($this->image) {
                $image = $this->sambat->image ?? new Image([
                    'imageable_id' => $this->sambat->id,
                    'imageable_type' => Sambat::class
                ]);
                $image->url = $this->image->storePublicly('image', ['disk' => 'public']);

                $this->sambat->image()->save($image);
            }

            // remove all tags and assign new
            $this->sambat->tags()->detach();
            foreach ($this->tags as $item) {
                $tag = Tag::firstOrCreate(['name' => $item]);
                $this->sambat->tags()->attach($tag);
            }

            return redirect()->route('user.sambat')->with('success', 'Mantap, udah nyambat !!');
        } catch (\Exception $e) {
            debugbar()->addMessage($e->getMessage());
            $this->emit('error', "Waduh gagal nyambat!!");
        }
    }

    public function render()
    {
        return view('sambat.form')
            ->layout('layouts.dashboard', [
                'title' => $this->sambat->id ? "Update Sambat" : "Buat Sambat"
            ]);
    }
}