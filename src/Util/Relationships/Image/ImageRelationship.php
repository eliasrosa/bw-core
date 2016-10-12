<?php

namespace BW\Util\Relationships\Image;

use BW\Util\Relationships\RelationshipBase;

abstract class ImageRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\Image\Models\Image';

    //
    static function getRelationship($model, $relation = array())
    {
        return  $model->hasOne(static::$model, 'ref_id')
                      ->where('relation_id', $relation['id']);
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
