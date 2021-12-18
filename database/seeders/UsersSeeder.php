<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Untuk BPH
        $jabatan_bph = [
            "Ketua", "Wakil Ketua KS", "Wakil Ketua ST", "Sekretaris I",
            "Sekretaris II", "Bendahara I", "Bendahara II"
        ];
        $iterasi = 0;
        User::factory()
            ->count(7)
            ->has(UserDetails::factory(), 'details')
            ->create()
            ->each(function ($user) use ($jabatan_bph, &$iterasi) {
                $user->assignRole(ROLE_BPH);
                $user->details()->update([
                    'pa_divisi' => 'BPH',
                    'pa_jabatan' => $jabatan_bph[$iterasi]
                ]);
                $iterasi += 1;
            });

        // anggota PA lainnya
        $anggota_pa = [
            ['divisi' => 'TI', 'jumlah' => 5, 'role' => ROLE_ADMIN],
            ['divisi' => 'Humas', 'jumlah' => 7, 'role' => ROLE_HUMAS],
            ['divisi' => 'Akademik', 'jumlah' => 16, 'role' => ROLE_AKADEMIK],
            ['divisi' => 'Event Organizer', 'jumlah' => 8],
            ['divisi' => 'Danus', 'jumlah' => 7],
            ['divisi' => 'Pubdok', 'jumlah' => 5],
        ];

        foreach ($anggota_pa as $anggota) {
            $has_koor = false;
            User::factory()
                ->count($anggota['jumlah'])
                ->has(UserDetails::factory(), 'details')
                ->create()
                ->each(function ($user) use (&$has_koor, &$anggota) {
                    if (isset($anggota['role']))
                        $user->assignRole($anggota['role']);

                    $user->details()->update([
                        'pa_divisi' => $anggota['divisi'],
                        'pa_jabatan' => !$has_koor ? 'Koordinator' : 'Anggota'
                    ]);
                    $has_koor = true;
                });
        }

        // mahasiswa lainnya
        User::factory()->count(400)->has(UserDetails::factory(), 'details')->create();
    }
}
