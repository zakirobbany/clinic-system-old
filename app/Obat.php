<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    //
    protected $fillable = ['nama_obat', 'harga', 'created_at', 'updated_at'];
    protected $table = 'obats';

    public function rekamMedis(){
        return $this->hasMany('App\RekamMedisObat')->with('RekamMedis');
    }

}
