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
            $idSatkerD3 = Satker::where('d3', '!=', 0)->get('id')->pluck('id');
            $idSatkerKS = Satker::where('ks', '!=', 0)->get('id')->pluck('id');
            $idSatkerST = Satker::where('st', '!=', 0)->get('id')->pluck('id');

            $users = User::permission(AppPermissions::SIMULATION_ACCESS)->with('details')->get();
            $simulation_times = $simulation->times;
            $session_count = $simulation_times->count();

            foreach ($users as $user) {
                if ($user->details["rank_" . AppSimulation::BASED_ON] === 0) continue;

                $max_rank = Cache::rememberForever("MAX_RANK_" . $user->details[AppSimulation::BASED_ON], function () use ($user) {
                    return UserDetails::where(AppSimulation::BASED_ON, $user->details[AppSimulation::BASED_ON])->max("rank_" . AppSimulation::BASED_ON);
                });

                $session = floor(($user->details["rank_" . AppSimulation::BASED_ON] - 1) / $max_rank * $session_count);

                $based_on = $user->details[AppSimulation::BASED_ON];
                if ($based_on == 'ks') $idSatker = $idSatkerKS;
                else if ($based_on == 'st') $idSatker = $idSatkerST;
                else if ($based_on == 'd3') $idSatker = $idSatkerD3;

                $satker1 = $this->faker->randomElement($idSatker);
                $satker2 = $this->faker->randomElement($idSatker);
                $satker3 = $this->faker->randomElement($idSatker);

                $user->formations()->create([
                    "based_on" => $based_on,
                    "user_rank" => $user->details["rank_" . AppSimulation::BASED_ON],
                    "session" => $session,
                    "session_id" => $simulation_times[$session]->id,
                    "simulations_id" => $simulation->id,
                    "satker_1" => $satker1,
                    "satker_2" => $satker2,
                    "satker_3" => $satker3,
                    "satker_final" => $this->faker->randomElement([$satker1, $satker2, $satker3]),
                    "satker_final_updated_at" => now()
                ]);
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
