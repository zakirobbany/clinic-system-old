<?php

use Illuminate\Database\Seeder;
use App\KategoriPasien;

class KategoriPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kategori_pasien = KategoriPasien::create([
            'nama_kategori' => 'Umum'
        ]);
    }
}
