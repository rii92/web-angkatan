<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Constants\AppActivity;
use App\Constants\AppKonsul;
use App\Models\Konsul;
use Livewire\Component;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DiscussionRoom extends Component
{
    public Konsul $konsul;
    public $category;

    protected $listeners = [
        'openRoom'
    ];

    public function mount()
    {
        if ($this->konsul->user_id != auth()->id()) abort(404);
        if ($this->category != $this->konsul->category) abort(404);
    }

    private function addActivity($message, $useView = true, $note = null)
    {
        $view = $useView ? view('components.konsultasi.status', ['status' => $this->konsul->status]) : '';
        $this->konsul->activity()->attach(auth()->user(), [
            'title' => "<b>{$this->konsul->name}</b> {$message} {$view}",
            'icon' => $this->konsul->is_anonim ? AppActivity::TYPE_ANONIM : AppActivity::TYPE_PHOTO,
            'note' => $note
        ]);
    }

    public function closeRoom()
    {
        if ($this->konsul->status != AppKonsul::STATUS_PROGRESS)
            return $this->emit('error', "Something wrong, you can't close this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_DONE;
        $this->konsul->done_at = now();
        $this->konsul->save();
        $this->addActivity('megakhiri konsultasi dan mengubah statusnya menjadi');

        return $this->emit('success', "Success to close this konsultasi. Do you want to publish your konsultasi?");
    }

    public function openRoom()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE)
            return $this->emit('error', "Something wrong, you can't open this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_PROGRESS;
        $this->konsul->done_at = null;
        $this->konsul->save();
        $this->addActivity('membuka kembali konsultasi dan mengubah statusnya menjadi');

        return $this->emit('success', "Success to open konsultasi");
    }

    public function publishKonsultasi()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE)
            return $this->emit('error', "Something wrong, you can't publish this konsultasi");

        $this->konsul->is_publish = true;
        $randomInt = Faker::create()->numerify(' #####');
        $this->konsul->slug = Str::slug(Str::limit($this->konsul->title, 60, '') . $randomInt);
        $this->konsul->published_at = now();
        $this->konsul->save();

        $this->addActivity('mempublish konsultasi', false, 'Konsultasi dipublish <a target="_blank" class="underline text-blue-600" href="' . route('konsultasi.detail', ['slug' => $this->konsul->slug]) . '"> disini</a>');


        return $this->emit('success', "Success to publish this konsultasi");
    }

    public function unpublishKonsultasi()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE)
            return $this->emit('error', "Something wrong, you can't unpublish this konsultasi");

        $this->konsul->is_publish = false;
        $this->konsul->published_at = null;
        $this->konsul->slug = null;
        $this->konsul->save();

        $this->addActivity('melakukan unpublish konsultasi', false);
        return $this->emit('success', "Success to unpublish this konsultasi");
    }

    public function render()
    {
        $this->konsul->markUnreadMessage(true);
        return view('mahasiswa.konsultasi.discussion-room')
            ->layout('layouts.dashboard', ['title' => "Discussion Room"]);
    }
}
