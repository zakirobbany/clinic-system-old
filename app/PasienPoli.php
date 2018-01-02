<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasienPoli extends Model
{
    protected $table = 'pasien_poli';

    protected $fillable = ['pasien_id', 'poli_id', 'dokter_id', 'updated_at', 'created_at', 'keluhan'];

    public function pasien(){
        return $this->belongsTo('App\Pasien');
    }

    public function poli(){
        return $this->belongsTo('App\Poli');
    }

    public function dokter(){
        return $this->belongsTo('App\Dokter');
    }

    public function rujukan(){
        return $this->hasOne('App\Rujukan', 'pasien_poli_id', 'id');
    }

    public function rekamMedis(){
        return $this->hasOne('App\RekamMedis', 'pasien_poli_id', 'id');
    }

    public function scopeUmumDay($query){
        return $query
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '1');
    }

}
