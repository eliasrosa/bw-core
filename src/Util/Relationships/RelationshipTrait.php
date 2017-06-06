<?php

namespace BW\Util\Relationships;

use LogicException;
use BW\Util\Relationships\Listing\ListingModelTrait;

trait RelationshipTrait
{
    //
    use ListingModelTrait;

    //
    public function __getRelationshipTrait($key)
    {
        $relation = $this->getRelationFromName($key);

        if(!is_null($relation)){

            if ($this->relationLoaded($key)) {
                return $this->relations[$key];
            }

            $relationship = $relation['type']::getRelationship($this, $relation);
            return $this->relations[$key] = $relationship->getResults();
        }

        return self::$MAGIC_METHOD_NO_RETURN;
    }

    //
    public function __callRelationshipTrait($method, $parameters)
    {
        $relation = $this->getRelationFromName($method);
        if(!is_null($relation)){
            return $relation['type']::getRelationship($this, $relation);
        }

        return self::$MAGIC_METHOD_NO_RETURN;
    }

    //
    public function getRelationFromName($key)
    {
        $relationship = \BWAdmin::get('relationships')->get()
            ->where('model', get_class())
            ->where('name', $key)
            ->first();

        return $relationship;
    }

    //
    public function saveRelationships()
    {
        $relationships = \BWAdmin::get('relationships')->get()
            ->where('model', get_class())
            ->where('parent', request('relation_id'));

        //
        $relationships->each(function($relation){
            $relation['type']::attach($this, $relation);
        });
    }

    public function deleteRelationships()
    {
        $relationships = \BWAdmin::get('relationships')->get()
            ->where('model', get_class())
            ->where('parent', request('relation_id'));

        //
        $relationships->each(function($relation){
            $relation['type']::detach($this, $relation);
        });
    }
}
