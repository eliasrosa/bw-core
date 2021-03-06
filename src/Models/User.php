<?php

namespace BW\Models;

use BW\Util\Relationships\RelationshipTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                       AuthorizableContract,
                                       CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, RelationshipTrait;

    //
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'status'];
    protected $hidden = ['password', 'remember_token'];

    //
    public function group()
    {
        return $this->belongsTo('BW\Models\UserGroup');
    }

    //
    public function hasPermission($permission) {

        if($this->group->super_administrator){
            return true;
        }

        return (bool) $this->group->permissions()
            ->where('permission', $permission)
            ->first();
    }

}
