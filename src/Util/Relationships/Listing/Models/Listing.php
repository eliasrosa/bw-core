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
    protected $fillable = ['name', 'email', 'password', 'status'];

    public function ref()
    {
         $relation = \BWAdmin::get('relationships')
            ->get($this->relation_id)
            ->first();

        return $this->morphedByMany($relation['model'], 'listable', 'listings_rel', 'list_id');
    }
}
