<?php

namespace App\Jobs;

use App\Models\Simulations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckSimulationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $simulations = Simulations::with('times')->get();

        foreach ($simulations as $simulation) {
            $totalSessions = $simulation->times->count();

            if ($totalSessions < 1) continue;

            $started_at = $simulation->times[0]->start_time;

            $ended_at = $simulation->times[$totalSessions - 1]->end_time;

            if ($started_at < now() && $ended_at > now()->addMinutes(-5)) {
                echo "Running Job for simulation with id: {$simulation->id} ({$simulation->title}) \n";
                FormationsSimulationJob::dispatchSync($simulation->id);
            }
        }
    }
}

// App\Jobs\CheckSimulationsJob::dispatchSync()