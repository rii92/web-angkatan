<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Models\UserFormations;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Str;

class UsersTable extends DataTableComponent
{
    public int $simulation_id;

    public string $defaultSortColumn = 'session';

    public string $defaultSortDirection = 'desc';

    public array $perPageAccepted = [10, 15];

    public string $pageName = 'users_table';

    public string $tableName = 'users_formations';

    public function columns(): array
    {
        return [
            Column::make("id"),
            Column::make("name", "user.name")
                ->searchable(),
            Column::make(AppSimulation::BASED_ON, "based_on")
                ->format(fn ($value) => Str::upper($value)),
            Column::make("sesi", "session"),
            Column::make("rank " . AppSimulation::BASED_ON, "user_rank")
        ];
    }

    public function filters(): array
    {
        return [
            'formation' => Filter::make('formation')
                ->select(array_merge(['' => "All"], AppSimulation::BASED_ON()))
        ];
    }

    public function query()
    {
        return UserFormations::with(['user'])
            ->where("simulations_id", $this->simulation_id)
            ->when($this->getFilter('formation'), function ($query, $formation) {
                $query->where("based_on", $formation);
            });
    }
}
