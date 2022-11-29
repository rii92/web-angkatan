<?php

namespace App\Http\Livewire\Admin\Satker;

use App\Constants\AppPermissions;
use App\Constants\AppSimulation;
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
        $baseRules = [
            'satker.kode_wilayah' => 'required|integer|digits_between:1,4' ,
            'satker.name' => 'required',
            'locationSearch' => 'nullable|exists:locations,kabupaten'
        ];

        $formationRules = [];

        foreach (AppSimulation::BASED_ON() as $key => $value)
            $formationRules["satker." . $key] = "nullable|integer";

        return array_merge($baseRules, $formationRules);
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
            $this->emit('reloadComponents', 'admin.satker.table');
        }
    }


    public function render()
    {
        $search = '%' . $this->locationSearch . '%';

        $this->locations = Str::of($this->locationSearch)->trim()->isNotEmpty()
            ? Location::where(DB::raw('lower(kabupaten)'), 'like', strtolower($search))->limit(3)->get()
            : [];

        return view('admin.satker.modal-add-edit');
    }
}
