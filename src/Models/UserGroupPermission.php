<?php

namespace BW\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroupPermission extends Model
{
    //
    protected $table = 'users_groups_permissions';
    public $timestamps = false;

    //
    protected $fillable = array('permission');

    //
    public function group()
    {
        return $this->belongsTo('BW\Models\UserGroup');
    }
}
