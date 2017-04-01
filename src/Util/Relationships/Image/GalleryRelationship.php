<?php

namespace BW\Util\Relationships\Image;

use BW\Util\Relationships\RelationshipBase;

abstract class GalleryRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\Image\Models\Gallery';
    
    //
    static function getManagerRouterFile()
    {
        return __DIR__ . '/../../../../routes/admin-image-gallery.php';
    }

    //
    static function getRelationship($model, $relation = array())
    {
        return  $model->hasMany(static::$model, 'ref_id')
                      ->where('relation_id', $relation['id'])
                      ->orderBy('position');
    }

    //
    static function addFormField($form, $relation)
    {
        $title = isset($relation['title']) ? $relation['title'] : ucfirst($relation['name']);
        $width = isset($relation['width']) ? $relation['width'] : 12;

        //
        $form->addItem('BW\Util\Relationships\Image\GalleryField', [
            $relation['name'],
            $title
        ])->setWidth($width)
          ->setRelation($relation);
    }
}
