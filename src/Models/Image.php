<?php

namespace BW\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\Traits\RelationshipTrait;

class Image extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'images';
    protected $fillable = [];

    //
    static function getRelationship($model, $relation = array()){

        //
        return  $model->hasOne(get_class(), 'ref_id')
                      ->where('relation_id', $relation['id']);
    }

    //
    public function ref()
    {
        $relation = \BWAdmin::get('relationships')->get($this->relation_id)->first();

        //
        return $this->belongsTo($relation['model']);
    }
}
