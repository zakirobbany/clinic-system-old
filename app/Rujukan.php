<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    protected $table = 'rujukans';
    protected $fillable = ['pasien_poli_id', 'rujukan', 'keterangan', 'created_at', 'updated_at', 'rekam_medis_id'];

    public function pasienPoli(){
        return $this->belongsTo('App\PasienPoli', 'pasien_poli_id', 'id');
    }

    public function rekamMedis(){
        return $this->belongsTo('App\RekamMedis');
    }
}
