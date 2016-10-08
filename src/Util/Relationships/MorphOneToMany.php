<?php

namespace BW\Util\Relationships;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MorphOneToMany extends \Illuminate\Database\Eloquent\Relations\MorphToMany
{

    public function __construct(Builder $query, Model $parent, $name, $table, $foreignKey, $otherKey, $relationName = null, $inverse = false, $relation_id = null)
    {
        $this->relation_id = $relation_id;
        parent::__construct($query, $parent, $name, $table, $foreignKey, $otherKey, $relationName, $inverse);
    }


    //
    public function getResults()
    {
        //
        $this->query = $this->query->where('relation_id', $this->relation_id);

        if($this->inverse === false){
            return $this->query->first();
        }

        return $this->query->get();
    }

    //
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);

        foreach ($models as $model) {
            $key = $model->getKey();

            //
            if (isset($dictionary[$key])) {
                $type = ($this->inverse === false) ? 'one' : 'many';
                $value = $this->getRelationValue($dictionary, $key, $type);
                $model->setRelation($relation, $value);
            }else{
                $model->setRelation($relation, null);
            }
        }

        return $models;
    }

    //
    protected function getRelationValue(array $dictionary, $key, $type)
    {
        $value = $dictionary[$key];
        return $type == 'one' ? reset($value) : $this->related->newCollection($value);
    }
}
