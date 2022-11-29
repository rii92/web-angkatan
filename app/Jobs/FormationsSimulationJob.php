<?php

namespace App\Jobs;

use App\Constants\AppSimulation;
use App\Models\Satker;
use App\Models\Simulations;
use App\Models\UserFormations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FormationsSimulationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Simulations $simulation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($simulation_id)
    {
        $this->simulation = Simulations::find($simulation_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        UserFormations::where('simulations_id', $this->simulation->id)->update([
            'satker_final_completed' => false,
            'satker_final' => null
        ]);

        foreach (AppSimulation::BASED_ON() as $key => $value) {
            $users = UserFormations::where('simulations_id', $this->simulation->id)
                ->whereNotNull('satker_1')
                ->where("based_on", $key)
                ->orderBy("user_rank", "asc")
                ->get();

            echo "{$value} : {$users->count()}\n";

            foreach ($users as $user) {
                $is_aman = false;

                foreach ([1, 2, 3] as $f) {
                    $satker = Satker::with([
                        'formation_final' => function ($query) use ($key) {
                            $query->where('based_on', $key)
                                ->where('simulations_id', $this->simulation->id)
                                ->where('satker_final_completed', true)
                                ->orderBy('user_rank');
                        }
                    ])->find($user["satker_{$f}"]);

                    if ($satker->formation_final->count() >= $satker[$key]) continue;

                    UserFormations::where('user_id', $user->user_id)
                        ->where('simulations_id', $this->simulation->id)
                        ->update([
                            'satker_final' => $satker->id,
                            'satker_final_completed' => true,
                            'satker_final_updated_at' => now(),
                            'status_pilihan' => AppSimulation::STATUS_PILIHAN_AMAN,
                            'satker_final_keterangan' => "Terpilih pada pilihan " . $f
                        ]);

                    $is_aman = true;

                    break;
                }

                if (!$is_aman)
                    UserFormations::where('user_id', $user->user_id)
                        ->where('simulations_id', $this->simulation->id)
                        ->update([
                            'satker_final_updated_at' => now(),
                            'status_pilihan' => AppSimulation::STATUS_PILIHAN_TIDAK_AMAN,
                            'satker_final_keterangan' => "Ketiga pilihan tidak aman"
                        ]);
            }

            echo "{$value} completed\n";
        }
    }
}
