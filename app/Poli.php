<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = ['nama_poli', 'created_at', 'updated_at'];

    public function pasiens(){
        return $this->hasMany('App\PasienPoli')->with('Pasien');
    }

}
