<?php

namespace App\Http\Livewire\Konsultasi;

use Livewire\Component;
use App\Models\Konsul;

class Form extends Component
{
    private $konsul, $konsulChat;
    public $konsul_id, $catagory;
    protected $listeners = ['submitForm' => 'handleForm'];

    public function rules()
    {
        return [
            'konsul.title' => 'required',
            'konsul.chat' => 'required',
        ];
    }

    public function mount()
    {
        if ($this->konsul_id) {
            $this->konsul = Konsul::find($this->konsul_id);
            $this->konsulChat = $this->konsul->chat();
        } else {
            $this->konsul = new Konsul();
            $this->konsul->catagory = $this->catagory;
        }
    }

    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm($chat)
    {
        $this->konsul->chat = $chat;
        $this->validate();

        try {
            $this->konsul->published_at = $this->konsul->published_at ?? now();
            $this->konsul->save();

            if ($this->konsul_id) return $this->emit('success', "Changes Saved Successfully");
            return redirect()->route('konsultasi.table')->with('message', 'Success to add new konsultasi');
        } catch (\Exception $e) {
            $this->emit('error', "Somethings Wrong, I can feel it");
        }
    }

    public function render()
    {
        return view('konsultasi.form', ['konsul' => $this->konsul, 'kosulChat' => $this->konsulChat]);
    }
}
