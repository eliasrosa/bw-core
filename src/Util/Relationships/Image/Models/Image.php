<?php

namespace BW\Util\Relationships\Image\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\RelationshipTrait;

class Image extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'images';
    protected $fillable = [];

    //
    public function ref()
    {
        $relation = \BWAdmin::get('relationships')
            ->get($this->relation_id)
            ->first();

        //
        return $this->belongsTo($relation['model']);
    }
}
