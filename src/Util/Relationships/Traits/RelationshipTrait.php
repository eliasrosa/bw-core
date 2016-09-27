<?php

namespace BW\Util\Relationships\Traits;

use LogicException;

trait RelationshipTrait
{
    //
    private function getModelFromName($key)
    {
        $relationship = \BWAdmin::get('relationships')->get()
            ->where('model', get_class())
            ->where('name', $key)
            ->first();

        return $relationship;
    }

    //
    public function __get($key)
    {
        $model = $this->getModelFromName($key);
        if(!is_null($model)){

            if ($this->relationLoaded($key)) {
                return $this->relations[$key];
            }

            $relations = $model['type']::getRelationship($this, $model);
            return $this->relations[$key] = $relations->getResults();
        }

        return parent::__get($key);
    }

    //
    public function __call($method, $parameters)
    {

        $model = $this->getModelFromName($method);
        if(!is_null($model)){
            return $model['type']::getRelationship($this, $model);
        }

        return parent::__call($method, $parameters);
    }
}
