<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    public $incrementing = false;
    protected $fillable = ['id', 'nama', 'alamat', 'no_telepon', 'umur',
                            'jenis_kelamin', 'riwayat_alergi', 'created_at', 'updated_at', 'id_kategori'
    ];

    protected $table = 'pasiens';

    public function KategoriPasien(){
        return $this->belongsTo('App\KategoriPasien', 'id_kategori', 'id_kategori');
    }

    public function polis(){
        return $this->hasMany('App\PasienPoli')->with('Poli');
    }

    public function Prolanis(){
        return $this->hasMany('App\Prolanis');
    }
}
