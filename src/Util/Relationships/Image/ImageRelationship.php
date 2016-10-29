<?php

namespace BW\Util\Relationships\Image;

use Image;
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
        $form->addFile($field['name'], $title)
            ->addAttribute('accept', 'image/gif, image/jpeg, image/png')
            ->setWidth($width);
    }

    static function attach($model, $relation = [])
    {
        Image::make(\Input::file($relation['name']))
            ->resize(300, 200)
            ->save('image/foo.jpg');
    }

    //
    static function detach($model, $relation = [])
    {

    }
}
