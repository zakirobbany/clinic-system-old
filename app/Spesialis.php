<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesialis extends Model
{
    protected $fillable = ['nama_spesialis'];
    public $timestamps = false;

    public function dokter(){
        return $this->hasMany('App\Dokter');
    }
}
