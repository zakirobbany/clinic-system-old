<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamMedisObat extends Model
{
    protected $fillable = ['obat_id', 'rekam_medis_id', 'jumlah', 'created_at', 'updated_at'];
    protected $table = 'rekam_medis_obats';

    public function obat(){
        return $this->belongsTo('App\Obat');
    }

    public function rekamMedis(){
        return $this->belongsTo('App\RekamMedis');
    }

}
