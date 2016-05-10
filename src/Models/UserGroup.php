<?php

namespace BW\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    //
    protected $table = 'users_groups';
    protected $fillable = ['name', 'description', 'status'];

    //
    public function users()
    {
        return $this->hasMany('BW\Models\User');
    }

    //
    public function permissions()
    {
        return $this->hasMany('BW\Models\UserGroupPermission', 'group_id');
    }
}
