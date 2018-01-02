<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['name', 'alamat', 'tanggal_lahir', 'no_telepon',
                            'email', 'personal_site', 'spesialisasi', 'created_at', 'updated_at'];
}
