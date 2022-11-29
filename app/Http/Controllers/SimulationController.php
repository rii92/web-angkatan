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
        $query =  Satker::select('locations.provinsi')
            ->join('locations', 'locations.id', '=', 'satkers.location_id')
            ->groupbyRaw('locations.provinsi, ks, st, d3')
            ->where('locations.provinsi', $provinsi);

        foreach (AppSimulation::BASED_ON() as $formation => $value) {

            $query->selectRaw("(SELECT SUM($formation) FROM satkers WHERE EXISTS (SELECT 1 FROM locations WHERE locations.id = satkers.location_id AND locations.provinsi = '$provinsi')) as $formation");

            foreach ([1, 2, 3, "final"] as $pilihan)
                $query->leftJoin("users_formations as formation_{$pilihan}_{$formation}", function ($join) use ($formation, $pilihan, $simulation) {
                    $join->on("formation_{$pilihan}_{$formation}.satker_{$pilihan}", '=', 'locations.id')
                        ->where("formation_{$pilihan}_{$formation}.based_on", $formation)
                        ->where("formation_{$pilihan}_{$formation}.simulations_id", $simulation->id);
                })
                    ->selectRaw("COUNT(DISTINCT formation_{$pilihan}_{$formation}.user_id) as formation_{$pilihan}_{$formation}");
        }

        $satker = $query->get();

        if (!count($satker))
            return abort(404);

        return view('mahasiswa.simulation.details-satker', [
            'simulation' => $simulation,
            'satker' => $satker[0],
            'type' => 'prov'
        ]);
    }
}
