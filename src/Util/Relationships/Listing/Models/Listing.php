<?php

namespace BW\Util\Relationships\Listing\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\MorphOneToMany;
use BW\Util\Relationships\RelationshipTrait;

class Listing extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'listings';
    protected $fillable = [];
}
