<?php

use Illuminate\Database\Seeder;
use App\Pasien;

class PasiensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sample pasien
        $pasien = Pasien::create([
            'nama' => 'Vika Trisnaningtyas',
            'Alamat' => 'Pacitan',
            'no_telepon' => '087758596405',
            'umur' => '21',
            'jenis_kelamin' => 'L',
            'riwayat_alergi' => 'alergi udang'
        ]);
    }
}
