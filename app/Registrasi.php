<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $fillable = ['name', 'display_name', 'alamat', 'tanggal_lahir', 'no_telepon',
        'email', 'personal_site', 'spesialisasi', 'created_at', 'updated_at', 'user_id'];

    public function absensis(){
        return $this->hasMany('App\Absensi');
    }
    public function prolanis(){
        return $this->hasMany('App\Prolanis');
    }

    public function getTanggalLahirAttribute($value)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
        return $tanggal;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
}
