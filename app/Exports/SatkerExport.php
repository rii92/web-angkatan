<?php

namespace App\Exports;

use App\Constants\AppSimulation;
use App\Exports\Sheets\SatkerPerProv;
use App\Exports\Sheets\SatkerSummary;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SatkerExport implements WithMultipleSheets
{
    use Exportable;

    private $selectedRowQuery;
    private $simulation;


    public function __construct(Builder $selectedRowQuery, $simulation)
    {
        $this->selectedRowQuery = $selectedRowQuery;
        $this->simulation = $simulation;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [new SatkerSummary($this->selectedRowQuery->clone(), $this->simulation)];

        // foreach (AppSimulation::PROVINSI_FILTER() as $prov => $value)
        //     $sheets[]  = new SatkerPerProv($this->selectedRowQuery->clone(), $prov, $this->simulation);

        return $sheets;
    }
}
