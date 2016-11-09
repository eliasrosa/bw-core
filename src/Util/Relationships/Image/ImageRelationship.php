<?php

namespace BW\Util\Relationships\Image;

use Input;
use Image;
use Storage;
use BW\Util\Relationships\RelationshipBase;

abstract class ImageRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\Image\Models\Image';
    static $validator = 'mimes:jpeg,bmp,png';

    //
    static function getRelationship($model, $relation = array())
    {
        return  $model->hasOne(static::$model, 'ref_id')
                      ->where('relation_id', $relation['id']);
    }

    //
    static function addFormField($form, $relation)
    {
        $title = isset($relation['title']) ? $relation['title'] : ucfirst($relation['name']);
        $width = isset($relation['width']) ? $relation['width'] : 12;

        $form->addImage($relation['name'], $title)
             ->setWidth($width);
    }

    static function attach($model, $relation = [])
    {
        $file = Input::file($relation['name']);

        if($file){
            if($model->{$relation['name']}){
                $image = $model->{$relation['name']};

                if(file_exists($image->getPath())){
                   unlink($image->getPath());
                }
            }else{
                $image = new $relation['type_model'];
            }

            //
            $img = Image::make($file);

            //
            $image->ref_id = $model->id;
            $image->relation_id = $relation['id'];
            $image->position = 0;
            $image->type = last(explode('/', $img->mime()));
            $image->save();

            //
            $img->save($image->getPath());
        }
    }

    //
    static function detach($model, $relation = [])
    {

    }
}
