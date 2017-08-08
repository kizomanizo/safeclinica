<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles()
        {
          return $this->belongsToMany('App\Http\Models\Role')->withTimestamps();
        }

    /**
     * Check whether the user has roles and what roles are those
     *
     * @return boolean
     */
    public function authorizeRoles($roles)
        {
            if ($this->hasAnyRole($roles)) {
            return true;
        }
            abort(401, 'You are not authorized to perform this action.');
            return back();
        }

    public function hasAnyRole($roles)
        {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
            return false;
        }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}