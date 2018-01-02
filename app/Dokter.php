<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = ['name', 'display_name', 'alamat', 'tanggal_lahir', 'no_telepon',
        'email', 'personal_site', 'spesialisasi', 'created_at', 'updated_at', 'user_id', 'spesialis_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($dokter){
            $dokter->user()->delete();
        });
    }

    public function spesialis(){
        return $this->belongsTo('App\Spesialis');
    }

    public function pasienPolis(){
        return $this->hasMany('App\PasienPoli');
    }

    public function absensis(){
        return $this->hasMany('App\Absensi');
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
