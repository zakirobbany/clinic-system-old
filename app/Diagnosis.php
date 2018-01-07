<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'name',
    ];

    public function diagnosisType()
    {
        return $this->belongsTo(DiagnosisType::class);
    }
}
