<?php

namespace Database\Factories;

use App\Constants\AppPermissions;
use App\Constants\AppSimulation;
use App\Models\Satker;
use App\Models\Simulations;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Cache;

class SimulationsFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Simulations $simulation) {

            $users = User::permission(AppPermissions::SIMULATION_ACCESS)->with('details')->get();

            $simulation_times = $simulation->times;

            $session_count = $simulation_times->count();

            foreach (AppSimulation::BASED_ON() as $key => $value) {
                $idSatkers = Satker::where($key, '!=', 0)->get('id')->pluck('id');

                foreach ($users as $user) {
                    if ($user->details["rank_" . AppSimulation::BASED_ON] === 0) continue;

                    $based_on = $user->details[AppSimulation::BASED_ON];

                    if ($based_on !== $key) continue;

                    $max_rank = Cache::rememberForever("MAX_RANK_" . $user->details[AppSimulation::BASED_ON], function () use ($user) {
                        return UserDetails::where(AppSimulation::BASED_ON, $user->details[AppSimulation::BASED_ON])->max("rank_" . AppSimulation::BASED_ON);
                    });

                    $session = floor(($user->details["rank_" . AppSimulation::BASED_ON] - 1) / $max_rank * $session_count);

                    $satker1 = $this->faker->randomElement($idSatkers);

                    $satker2 = $this->faker->randomElement($idSatkers);

                    $satker3 = $this->faker->randomElement($idSatkers);

                    $user->formations()->updateOrCreate([
                        "based_on" => $based_on,
                        "user_rank" => $user->details["rank_" . AppSimulation::BASED_ON],
                        "session" => $session,
                        "session_id" => $simulation_times[$session]->id,
                        "satker_1" => $satker1,
                        "satker_2" => $satker2,
                        "satker_3" => $satker3,
                        "satker_final" => null,
                        "satker_final_updated_at" => now(),
                        "user_selection_at" => now(),
                    ], ["simulations_id" => $simulation->id,]);
                };
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(3, 5))
        ];
    }
}
