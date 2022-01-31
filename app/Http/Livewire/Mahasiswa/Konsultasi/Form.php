<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Constants\AppKonsul;
use Livewire\Component;
use App\Models\Konsul;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\BellNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Form extends Component
{
    public $konsul, $konsul_id, $category;
    public $tags = '';
    protected $listeners = ['submitForm' => 'handleForm'];
    public $hastags, $placeholder;

    public function rules()
    {
        return [
            'konsul.title' => 'required',
            'konsul.description' => 'required',
            'konsul.is_anonim' => 'nullable',
            'konsul.category' => 'required',
            'hastags' => 'required|array|max:5|min:1'
        ];
    }

    public function mount()
    {
        // jika konsul id ada berarti mau edit
        if ($this->konsul_id) {
            $this->konsul = Konsul::find($this->konsul_id);
            // hanya boleh edit ketika statusnya wait
            if (($this->konsul->user_id != auth()->id()) || ($this->konsul->status != AppKonsul::STATUS_WAIT)) abort(404);

            // ini menjaga agar kategori umum tidak bisa dibuka dari /akademik dan sebaliknya
            if ($this->konsul->category != $this->category) abort(404);

            // componen tagnya untuk nerima nilai inisialiasi harus dalam bentuk string yang dipisah oleh spasi
            $this->tags = $this->konsul->tags->pluck('name')->implode(' ');
        } else {
            $this->konsul = new Konsul();
            $this->konsul->category = $this->category;
        }

        if ($this->konsul->category == AppKonsul::TYPE_AKADEMIK)
            $this->placeholder = "Bagaimana melakukan analisis panel di R?";
        else
            $this->placeholder = "Bagaimana cara meredakan stress akibat skripsi?";
    }

    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm($description, $tags)
    {

        // hanya bisa edit ketika statusnya wait, kondisi jarang tapi bisa terjadi. Admin sudah ubah statusnya
        // tapi si penanya masih ada di halaman edit sehingga dia masih bisa melakukan edit
        $konsul = Konsul::find($this->konsul_id);
        if ($this->konsul_id && $konsul->status != AppKonsul::STATUS_WAIT)
            return redirect()->route("user.konsultasi.{$this->category}.room", $this->konsul->id)->with('error', "You can't change this konsultasi again");

        $this->konsul->description = $description;
        $this->hastags = $tags;
        $this->validate();

        $user = auth()->user();
        if (!$this->konsul_id) {
            $this->konsul->is_anonim = $this->konsul->is_anonim ? 1 : 0;
            $this->konsul->user_id = $user->id;
        } else
            # sengaja dibuat gini karena kalau updatenya hanya
            # tags maka di updated_at ga bakalan berubah
            $this->konsul->updated_at = now();


        try {
            // pakai transaction biar kalau ada yang gagal, datanya tidak keupdate sebagian
            DB::beginTransaction();

            $this->konsul->save();
            $this->konsul->name = $this->konsul->is_anonim ?  "Anonim_{$this->konsul->id}" : $user->name;
            $this->konsul->save();


            // biar ga ribet ketika edit, tagnya di detach semua aja dulu terus diinput lagi
            $this->konsul->tags()->detach();
            foreach ($this->hastags as $tag) {
                $tag = Tag::updateOrCreate(['name' => $tag]);
                $this->konsul->tags()->save($tag);
            }
            DB::commit();

            if ($this->konsul_id) return $this->emit('success', "Changes Saved Successfully");

            // jika membuat konsultasi akademik baru, kirim bell notifikasi ke konselor yang bertugas
            if ($this->konsul->category == AppKonsul::TYPE_AKADEMIK) {
                $penanya = User::find($this->konsul->user_id);
                $konselor = AppKonsul::getKonselor(now()->dayOfWeek, $penanya->details->jurusan);
                $title = Str::limit($this->konsul->title, 40);
                $message = "Hai konselor, terdapat konsultasi baru berjudul <b>{$title}</b>";
                $url = route("admin.konsultasi.{$this->category}.room", $this->konsul->id);

                foreach ($konselor as $nim)
                    User::where('email', $nim . '@stis.ac.id')->first()->notify(new BellNotification($message, $url));
            }

            return redirect()->route("user.konsultasi.{$this->category}.room", $this->konsul->id)->with('message', 'Success to add new konsultasi');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', "Somethings Wrong, I can feel it");
        }
    }

    public function render()
    {
        return view('mahasiswa.konsultasi.form');
    }
}
