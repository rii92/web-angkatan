<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $awalan_nim = $this->faker->randomElement(['221810', '211810']);
        $nim = $awalan_nim .  $this->faker->unique()->numerify('###');

        if ($awalan_nim == '221810') {
            $jurusan = $this->faker->randomElement(['SD', 'SI']);
            $nomor_kelas = $this->faker->randomElement(['1', '2']);
        } else {
            $jurusan = $this->faker->randomElement(['SK', 'SE']);
            $nomor_kelas = $this->faker->randomElement(['1', '2', '3', '4', '5']);
        }
        $kelas = '4' . $jurusan . $nomor_kelas;

        return [
            'nim' => $nim,
            'kelas' => $kelas,
            'no_hp' => $this->faker->numerify('08##########'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'location_id' => Location::pluck('id')->random(),
            'alamat_rumah' => $this->faker->address(),
            'alamat_kos' => $this->faker->address(),
            'skripsi_dosbing' => $this->faker->name(),
            'skripsi_judul' => $this->faker->sentence(10),
            'skripsi_metode' => $this->faker->sentence(4),
            'skripsi_variabel_dependent' => $this->faker->sentence(20),
            'skripsi_variabel_independent' => $this->faker->sentence(20),
        ];
    }
}
