<?php

namespace App;

use Laratrust\LaratrustRole;
use Closure;

class Role extends LaratrustRole
{
    protected $fillable = ['name', 'display_name'];

    public function user()
    {
        return $this->belongsToMany('App\User', 'role_user', 'role_id', 'user_id');
    }

    public function handle($request, Closure $next, $role){
        if (\Auth::user()->can($role . '-access')){
            return $next($request);
        }
        return response('blank', 404);

    }

}
