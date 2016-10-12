<?php

namespace BW\Util\Relationships\ImageGroup;

use BW\Util\Relationships\RelationshipBase;

abstract class ImageGroupRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\ImageGroup\Models\ImageGroup';

    //
    static function getRelationship($model, $relation = array())
    {
        return  $model->hasMany(static::$model, 'ref_id')
                      ->where('relation_id', $relation['id'])
                      ->orderBy('position');
    }

    //
    static function addFormField($form, $field)
    {
        $title = isset($field['title']) ? $field['title'] : ucfirst($field['name']);
        $width = isset($field['width']) ? $field['width'] : 12;

        //
        $form->addText($field['name'], $title)
             ->setWidth($width);
    }

}
