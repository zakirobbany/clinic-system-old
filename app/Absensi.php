<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';
    protected $fillable = ['dokter_id', 'registrasi_id', 'created_at', 'updated_at'];

    public function dokter(){
        return $this->belongsTo('App\Dokter');
    }
    public  function registrasi(){
        return $this->belongsTo('App\Registrasi');
    }

}
