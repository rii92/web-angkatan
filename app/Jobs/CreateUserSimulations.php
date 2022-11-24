<?php

namespace App\Jobs;

use App\Constants\AppPermissions;
use App\Constants\AppSimulation;
use App\Models\Simulations;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CreateUserSimulations implements ShouldQueue
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
        $users = User::permission(AppPermissions::SIMULATION_ACCESS)->with('details')->get();
        $simulation_times = $this->simulation->times;
        $session_count = $simulation_times->count();

        foreach ($users as $user) {
            if ($user->details["rank_" . AppSimulation::BASED_ON] === 0) continue;

            $max_rank = Cache::rememberForever("MAX_RANK_" . $user->details[AppSimulation::BASED_ON], function () use ($user) {
                return UserDetails::where(AppSimulation::BASED_ON, $user->details[AppSimulation::BASED_ON])->max("rank_" . AppSimulation::BASED_ON);
            });

            $session = floor(($user->details["rank_" . AppSimulation::BASED_ON] - 1) / $max_rank * $session_count);

            $user->formations()->create([
                "based_on" => $user->details[AppSimulation::BASED_ON],
                "user_rank" => $user->details["rank_" . AppSimulation::BASED_ON],
                "session" => $session,
                "session_id" => $simulation_times[$session]->id,
                "simulations_id" => $this->simulation->id
            ]);
        }
    }
}

// App\Jobs\CreateUserSimulations::dispatchSync(App\Models\Simulations::find(1));
