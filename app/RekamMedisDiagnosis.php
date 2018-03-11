<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamMedisDiagnosis extends Model
{
    protected $fillable = [
        'rekam_medis_id',
        'diagnoses_id',
    ];

    protected $table = 'rekam_medis_diagnoses';

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo('App\Diagnosis', 'diagnoses_id');
    }
}
