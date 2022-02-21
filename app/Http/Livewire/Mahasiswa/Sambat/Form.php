<?php

namespace App\Http\Livewire\Mahasiswa\Sambat;

use App\Models\Sambat;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public Sambat $sambat;
    public $images = [], $tags, $hashtags, $sambat_id;

    protected $listeners = [
        'submitForm' => 'handleForm'
    ];

    public function rules()
    {
        return [
            'sambat.description' => 'required',
            'sambat.is_anonim' => 'required|boolean',
            'images.*' => 'nullable|image|max:2048',
            'hashtags' => 'required|array|max:5|min:1'
        ];
    }

    public function mount()
    {
        $this->sambat = $this->sambat_id ? Sambat::find($this->sambat_id) : new Sambat();
        $this->tags = $this->sambat_id ? $this->sambat->tags->pluck('name')->implode(' ') : '';
    }


    public function handleForm($description, $tags, $deleteUrl)
    {
        $this->sambat->description = $description;
        $this->sambat->user_id = Auth::user()->id;
        $this->hashtags = $tags;

        $this->validate();
        try {
            if ($this->sambat_id) $this->sambat->updated_at = now();
            $this->sambat->save();

            // image
            foreach ($this->images as $image) {
                $this->sambat->images()->create([
                    'url' => $image->storePublicly('sambat', ['disk' => 'public'])
                ]);
            }

            // delete image
            foreach ($deleteUrl as $url)
                $this->sambat->images()->where('url', $url)->delete();

            // remove all tags and assign new
            $this->sambat->tags()->detach();
            foreach ($this->hashtags as $item) {
                $tag = Tag::updateOrCreate(['name' => $item]);
                $this->sambat->tags()->save($tag);
            }

            if ($this->sambat_id) {
                if (!empty($this->images))
                    return redirect()->route('user.sambat.edit', ['sambat_id' => $this->sambat->id])
                        ->with('message', 'Perubahan berhasil disimpan');

                $this->sambat->load('images');
                return $this->emit('success', 'Perubahan berhasil disimpan');
            }

            return redirect()->route('user.sambat.table')->with('message', 'Mantap, udah nyambat !!');
        } catch (\Exception $e) {
            if ($this->sambat_id) return $this->emit('error', "Gagal menyimpan perubahan");
            return $this->emit('error', "Waduh gagal nyambat!!");
        }
    }

    public function render()
    {
        return view('mahasiswa.sambat.form')
            ->layout('layouts.dashboard', [
                'title' => $this->sambat_id ? "Update Sambat" : "Buat Sambat"
            ]);
    }
}
