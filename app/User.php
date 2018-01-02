<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dokter(){
        return $this->hasOne(Dokter::class);
    }

    public function registrasi(){
        return $this->hasOne(Registrasi::class);
    }

    public function role()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }


}
