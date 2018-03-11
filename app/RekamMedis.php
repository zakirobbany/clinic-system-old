<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $fillable = ['pasien_poli_id', 'diagnosa', 'terapi', 'created_at', 'updated_at'];

    public function pasienPoli(){
        return $this->belongsTo('App\PasienPoli', 'pasien_poli_id', 'id');
    }

    public function rujukan(){
        return $this->hasOne('App\Rujukan');
    }

    public function obat(){
        return $this->hasMany('App\RekamMedisObat')->with('Obat');
    }

    public function diagnoses()
    {
        return $this->hasMany('App\RekamMedisDiagnosis')->with('Diagnosis');
    }

    public function getDiagnosesAttributeAttribute()
    {
        return $this->diagnoses->pluck('diagnosis');
    }

    public function getMedicineAttributeAttribute()
    {
        return $this->obat->pluck('obat');
    }

    public function getTotalMedicineAttributeAttribute()
    {
        return $this->obat;
    }

}
