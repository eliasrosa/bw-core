<?php

namespace BW\Util\Relationships\Tag;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\RelationshipTrait;

class TagModel extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'tags';
    protected $fillable = [];

    //
    static $manager_menu = true;
    static $manager_menu_icon = 'fa fa-check-square-o';
    static $manager_menu_title = 'Gerenciar marcadores';
    static $manager_controller = '\BW\Controllers\Relationships\TagControllers';

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
