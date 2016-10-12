<?php

namespace BW\Util\Relationships\ImageGroup\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\RelationshipTrait;

class ImageGroup extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'images';
    protected $fillable = [];

    //
    static $manager_menu = false;

    //
    static function getRelationship($model, $relation = array())
    {
        return  $model->hasMany(get_class(), 'ref_id')
                      ->where('relation_id', $relation['id'])
                      ->orderBy('position');
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
        $relation = \BWAdmin::get('relationships')->get($this->relation_id)->first();

        return $this->belongsTo($relation['model']);
    }
}
