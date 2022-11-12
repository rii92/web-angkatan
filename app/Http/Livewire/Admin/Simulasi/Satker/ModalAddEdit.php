<?php

namespace App\Http\Livewire\Admin\Simulasi\Satker;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Location;
use App\Models\Satker;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;


class ModalAddEdit extends ModalComponent
{

    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_MANAGEMENT;

    public Satker $satker;

    public $satker_id;

    public $locationSearch;

    public $locations;


    public function rules()
    {
        return [
            'satker.name' => 'required',
            'locationSearch' => 'nullable|exists:locations,kabupaten',
            'satker.se_formation' => 'nullable|integer',
            'satker.sk_formation' => 'nullable|integer',
            'satker.si_formation' => 'nullable|integer',
            'satker.sd_formation' => 'nullable|integer',
            'satker.d3_formation' => 'nullable|integer',
            'satker.ks_formation' => 'nullable|integer',
            'satker.st_formation' => 'nullable|integer',
        ];
    }


    public function selectLocation($kabupaten)
    {
        $this->locationSearch = $kabupaten;

        $this->reset('locations');
    }


    public function mount()
    {
        $this->satker = $this->satker_id ? Satker::with('location')->find($this->satker_id) : new Satker();

        $location = $this->satker->location;
        $this->locationSearch = $location ? $location->kabupaten : null;
    }


    public function handleForm()
    {
        $this->validate();

        try {
            if ($this->locationSearch) {
                $location = Location::where('kabupaten', $this->locationSearch)->first();
                $this->satker->location_id = $location->id;
            } else {
                $this->satker->location_id = null;
            }

            $this->satker->save();

            $this->emit('success', "Berhasil " . ($this->satker_id ? 'mengubah' : 'menambah') . " Formasi Satker");
        } catch (\Exception $e) {
            $this->emit('error', "Gagal " . ($this->satker_id ? 'mengubah' : 'menambah') . " Formasi Satker");
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'admin.simulasi.satker.table');
        }
    }


    public function render()
    {
        $search = '%' . $this->locationSearch . '%';

        $this->locations = Str::of($this->locationSearch)->trim()->isNotEmpty()
            ? Location::where(DB::raw('lower(kabupaten)'), 'like', strtolower($search))->limit(3)->get()
            : [];

        return view('admin.simulasi.satker.modal-add-edit');
    }
}
