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

    public function ref()
    {
    	$relation = \BWAdmin::get('relationships')
            ->get($this->relation_id)
            ->first();

        return $this->morphedByMany($relation['model'], 'taggable', 'tags_rel', 'tag_id')
            ->withPivot('relation_id');
    }

}
