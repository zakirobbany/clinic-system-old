<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    protected $table = 'kpis';
    protected $fillable = ['kpi', 'bobot', 'created_at', 'updated_at'];

}
