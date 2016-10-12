<?php

namespace BW\Util\Relationships\Tag\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\RelationshipTrait;

class Tag extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'tags';
    protected $fillable = [];
}
