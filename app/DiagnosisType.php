<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosisType extends Model
{
    protected $fillable = [
      'name',
    ];

    public function Diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
