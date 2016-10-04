<?php

namespace BW\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\MorphOneToMany;
use BW\Util\Relationships\Traits\RelationshipTrait;

class Listing extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'listings';
    protected $fillable = [];

    //
    static function getRelationship($model, $relation = array()){

        $related = get_class();
        $instance = new $related;

        return new MorphOneToMany(
            $instance->newQuery(), $model, 'listable', 'listings_rel',
            'listable_id', 'list_id', 'ref', false
        );
    }

    // IMPORTANTE
    // O comando \BW\Models\Listing::with('ref') não está funcionando
    public function ref()
    {
        $relation = \BWAdmin::get('relationships')->get($this->relation_id)->first();

        $instance = new $relation['model'];
        return new MorphOneToMany(
            $instance->newQuery(), $this, 'listable', 'listings_rel',
            'list_id', 'listable_id', 'ref', true
        );
    }

}
