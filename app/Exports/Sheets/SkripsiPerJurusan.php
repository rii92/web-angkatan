<?php

namespace App\Exports\Sheets;

use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class SkripsiPerJurusan implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithColumnWidths, WithEvents
{
    use Exportable;

    private $selectedRowQuery;
    private $jurusan;

    public function __construct(Builder $selectedRowQuery, $jurusan)
    {
        $this->selectedRowQuery = $selectedRowQuery;
        $this->jurusan = $jurusan;
    }

    public function query()
    {
        return $this->selectedRowQuery->whereHas('details', function (Builder $query) {
            $query->where('kelas', 'like', "%{$this->jurusan}%");
        })->orderBy(
            UserDetails::select('kelas')
                ->whereColumn('user_id', 'users.id')
                ->orderBy('kelas')
        );
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->details->nim,
            $row->details->kelas,
            $row->details->skripsi_dosbing,
            $row->details->skripsi_judul,
            $row->details->skripsi_metode,
            $row->details->skripsi_variabel_dependent,
            $row->details->skripsi_variabel_independent,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Kelas',
            'Dosen Pembimbing',
            'Judul',
            'Metode',
            'Variabel Dependen',
            'Variabel Independen'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'E' => 60,
            'F' => 40,
            'G' => 60,
            'H' => 60
        ];
    }

    public function title(): string
    {
        return 'Jurusan ' . $this->jurusan;
    }

    /**
     * freeze first row
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane('B1'); // freezing first column
            },
        ];
    }
}
