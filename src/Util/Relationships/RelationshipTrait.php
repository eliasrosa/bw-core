<?php

namespace BW\Util\Relationships;

use LogicException;

trait RelationshipTrait
{
    //
    public function __get($key)
    {
        $relation = $this->getRelationFromName($key);

        if(!is_null($relation)){

            if ($this->relationLoaded($key)) {
                return $this->relations[$key];
            }

            $relationship = $relation['type']::getRelationship($this, $relation);
            return $this->relations[$key] = $relationship->getResults();
        }

        return parent::__get($key);
    }

    //
    public function __call($method, $parameters)
    {
        $relation = $this->getRelationFromName($method);
        if(!is_null($relation)){
            return $relation['type']::getRelationship($this, $relation);
        }

        return parent::__call($method, $parameters);
    }

    //
    private function getRelationFromName($key)
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
            ->where('parent', request('_relationship_parent'));

        //
        $relationships->each(function($relation){
            $relation['type']::attach($this, $relation);
        });
    }

    public function deleteRelationships()
    {
        $relationships = \BWAdmin::get('relationships')->get()
            ->where('model', get_class())
            ->where('parent', request('_relationship_parent'));

        //
        $relationships->each(function($relation){
            $relation['type']::detach($this, $relation);
        });
    }
}
