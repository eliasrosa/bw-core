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
    static function getRelationship($model, $relation = array())
    {
        return  $model->hasOne(get_class(), 'ref_id')
                      ->where('relation_id', $relation['id']);
    }

    //
    static function attachRelationships($model, $relation){}
    static function detachRelationships($model, $relation){}

    //
    static function addFormField($form, $field)
    {
        $title = isset($field['title']) ? $field['title'] : ucfirst($field['name']);
        $width = isset($field['width']) ? $field['width'] : 12;

        //
        $form->addText($field['name'], $title)
             ->setWidth($width);
    }

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
