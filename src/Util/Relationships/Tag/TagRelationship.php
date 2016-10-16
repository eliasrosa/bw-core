<?php

namespace BW\Util\Relationships\Tag;

use BW\Util\Relationships\RelationshipBase;

abstract class TagRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\Tag\Models\Tag';

    //
    static $manager_menu = false;
    static $manager_menu_icon = 'fa fa-check-square-o';
    static $manager_menu_title = 'Gerenciar marcadores';

    //
    static function getManagerRouterFile()
    {
        return __DIR__ . '/../../../../routes/admin-tag.php';
    }

    //
    static function getRelationship($model, $relation = array())
    {
        return $model->morphToMany(static::$model, 'taggable', 'relation_tags_rel');
    }

    //
    static function addFormField($form, $field)
    {
        $title = isset($field['title']) ? $field['title'] : ucfirst($field['name']);
        $width = isset($field['width']) ? $field['width'] : 6;

        //
        $form->addText($field['name'], $title)
             ->setWidth($width);
    }
}
