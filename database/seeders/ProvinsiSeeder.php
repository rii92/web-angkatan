<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provinsi::insert(array ( 0 => array ( 'prov_id' => 11, 'nama' => 'Aceh', ), 1 => array ( 'prov_id' => 12, 'nama' => 'Sumatera Utara', ), 2 => array ( 'prov_id' => 13, 'nama' => 'Sumatera Barat', ), 3 => array ( 'prov_id' => 14, 'nama' => 'Riau', ), 4 => array ( 'prov_id' => 15, 'nama' => 'Jambi', ), 5 => array ( 'prov_id' => 16, 'nama' => 'Sumatera Selatan', ), 6 => array ( 'prov_id' => 17, 'nama' => 'Bengkulu', ), 7 => array ( 'prov_id' => 18, 'nama' => 'Lampung', ), 8 => array ( 'prov_id' => 19, 'nama' => 'Kepulauan Bangka Belitung', ), 9 => array ( 'prov_id' => 21, 'nama' => 'Kepulauan Riau', ), 10 => array ( 'prov_id' => 31, 'nama' => 'Dki Jakarta', ), 11 => array ( 'prov_id' => 32, 'nama' => 'Jawa Barat', ), 12 => array ( 'prov_id' => 33, 'nama' => 'Jawa Tengah', ), 13 => array ( 'prov_id' => 34, 'nama' => 'Di Yogyakarta', ), 14 => array ( 'prov_id' => 35, 'nama' => 'Jawa Timur', ), 15 => array ( 'prov_id' => 36, 'nama' => 'Banten', ), 16 => array ( 'prov_id' => 51, 'nama' => 'Bali', ), 17 => array ( 'prov_id' => 52, 'nama' => 'Nusa Tenggara Barat', ), 18 => array ( 'prov_id' => 53, 'nama' => 'Nusa Tenggara Timur', ), 19 => array ( 'prov_id' => 61, 'nama' => 'Kalimantan Barat', ), 20 => array ( 'prov_id' => 62, 'nama' => 'Kalimantan Tengah', ), 21 => array ( 'prov_id' => 63, 'nama' => 'Kalimantan Selatan', ), 22 => array ( 'prov_id' => 64, 'nama' => 'Kalimantan Timur', ), 23 => array ( 'prov_id' => 65, 'nama' => 'Kalimantan Utara', ), 24 => array ( 'prov_id' => 71, 'nama' => 'Sulawesi Utara', ), 25 => array ( 'prov_id' => 72, 'nama' => 'Sulawesi Tengah', ), 26 => array ( 'prov_id' => 73, 'nama' => 'Sulawesi Selatan', ), 27 => array ( 'prov_id' => 74, 'nama' => 'Sulawesi Tenggara', ), 28 => array ( 'prov_id' => 75, 'nama' => 'Gorontalo', ), 29 => array ( 'prov_id' => 76, 'nama' => 'Sulawesi Barat', ), 30 => array ( 'prov_id' => 81, 'nama' => 'Maluku', ), 31 => array ( 'prov_id' => 82, 'nama' => 'Maluku Utara', ), 32 => array ( 'prov_id' => 91, 'nama' => 'Papua', ), 33 => array ( 'prov_id' => 92, 'nama' => 'Papua Barat', ), ));
    }
}
