<?php

namespace App\Jobs;

use App\Constants\AppSimulation;
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
    public function __construct(Simulations $simulation)
    {
        $this->simulation = $simulation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        UserFormations::where('simulations_id', $this->simulation->id)->update(['satker_final_completed' => false]);

        foreach (AppSimulation::BASED_ON() as $key => $value) {
            $users = UserFormations::where('simulations_id', $this->simulation->id)
                ->where('satker_1', "<>", null)
                ->where("based_on", $key)
                ->orderBy("user_rank", "asc")
                ->get();

            echo "{$value} : {$users->count()}\n";

            foreach ($users as $user) {
                // satker 1

                
            }


        }
    }
}
