<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prolanis extends Model
{
    protected $table = 'prolanis';
    protected $fillable = ['pasien_id', 'registrasi_id','created_at', 'updated_at'];

    public function pasien(){
        return $this->belongsTo('App\Pasien');
    }

    public  function registrasi(){
        return $this->belongsTo('App\Registrasi');
    }
}
