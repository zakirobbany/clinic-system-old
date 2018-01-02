<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPasien extends Model
{
    protected $fillable =['nama_kategori'];
    public $timestamps = false;

    public function pasien(){
        return $this->hasMany('App\Pasien', 'id_kategori');
    }
}
