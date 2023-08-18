<?php

namespace App\Http\Controllers;

use App\Constants\AppSimulation;
use App\Models\Satker;
use App\Models\Simulations;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SimulationController extends Controller
{
    public function detailSatkerKab(Simulations $simulation, $satker)
    {
        $countList = [];
        foreach ([1, 2, 3, "final"] as $pilihan)
            foreach (AppSimulation::BASED_ON() as $formation => $value)
                $countList = array_merge($countList, [
                    "formation_{$pilihan} as formation_{$pilihan}_{$formation}" => function (Builder $query) use ($simulation, $formation) {
                        $query->where("based_on", $formation)
                            ->where('simulations_id', $simulation->id);
                    }
                ]);

        $satker = Satker::with('location')
            ->withCount($countList)
            ->findOrFail($satker);

        return view('mahasiswa.simulation.details-satker', [
            'simulation' => $simulation,
            'satker' => $satker,
            'type' => 'kab'
        ]);
    }

    public function detailSatkerProv(Simulations $simulation, $provinsi)
    {
        $countAttr = [];

        foreach ([1, 2, 3, 'final'] as $p) {
            foreach (AppSimulation::BASED_ON() as $key => $value) {
                $countAttr["formation_{$p} as formation_{$p}_{$key}"] = function (Builder $query) use ($key, $simulation) {
                    $query->where('based_on', $key)
                        ->where('simulations_id', $simulation->id);
                };
            }
        }

        $allSatkers = Satker::withCount($countAttr)
            ->whereRelation('location', 'provinsi', $provinsi)->get();


        if (!count($allSatkers)) return abort(404);

        $result = [
            "provinsi" => $provinsi
        ];

        foreach (AppSimulation::BASED_ON() as $key => $value) {
            $result[$key] = $allSatkers->sum($key);

            foreach ([1, 2, 3, 'final'] as $p) {

                $result["formation_{$p}_{$key}"] = $allSatkers->sum("formation_{$p}_{$key}");
            }
        }

        $result = (object) $result;

        return view('mahasiswa.simulation.details-satker', [
            'simulation' => $simulation,
            'satker' => $result,
            'type' => 'prov'
        ]);
    }
}
