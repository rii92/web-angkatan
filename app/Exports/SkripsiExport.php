<?php

namespace App\Exports;

use App\Exports\Sheets\SkripsiPerJurusan;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SkripsiExport implements WithMultipleSheets
{
    use Exportable;

    private $selectedRowQuery;

    public function __construct(Builder $selectedRowQuery)
    {
        $this->selectedRowQuery = $selectedRowQuery;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        foreach (["SD", "SI", "SK", "SE", "D3"] as $jurusan) {
            $sheets[]  = new SkripsiPerJurusan($this->selectedRowQuery->clone(), $jurusan);
        }

        return $sheets;
    }
}
