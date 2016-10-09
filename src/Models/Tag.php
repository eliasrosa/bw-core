<?php

namespace BW\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\Traits\RelationshipTrait;

class Tag extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'tags';
    protected $fillable = [];

    //
    static function getRelationship($model, $relation = array())
    {
        return $model->morphToMany(get_class(), 'taggable', 'relation_tags_rel');
    }

    //
    static function attachRelationships($model, $relation){}
    static function detachRelationships($model, $relation){}

    //
    static function addFormField($form, $field)
    {
        $title = isset($field['title']) ? $field['title'] : ucfirst($field['name']);
        $width = isset($field['width']) ? $field['width'] : 6;

        //
        $form->addText($field['name'], $title)
             ->setWidth($width);
    }

    // IMPORTANTE
    // O comando \BW\Models\Tag::with('ref') não está funcionando
    public function ref()
    {
        $relation = \BWAdmin::get('relationships')->get($this->relation_id)->first();

        return $this->morphedByMany($relation['model'], 'taggable', 'relation_tags_rel');
    }

}
