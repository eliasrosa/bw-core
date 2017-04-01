<?php

namespace BW\Util\Relationships\Listing;

use BW\Util\Relationships\MorphOneToMany;
use BW\Util\Relationships\RelationshipBase;

abstract class ListingRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\Listing\Models\Listing';
    static $validator = 'required|not_in:0';

    //
    static $manager_menu = true;
    static $manager_menu_icon = 'fa fa-list';
    static $manager_menu_title = 'Gerenciar listas';
    static $manager_menu_route = 'bw.relationships.listing.index';

    //
    static function getManagerRouterFile()
    {
        return __DIR__ . '/../../../../routes/admin-listing.php';
    }

    //
    static function getRelationship($model, $relation = [])
    {
        $instance = new static::$model;
        return new MorphOneToMany(
            $instance->newQuery(), $model, 'listable', 'listings_rel',
            'listable_id', 'list_id', 'ref', false, $relation['id']
        );
    }

    //
    static function attach($model, $relation = [])
    {
        $relationship = $model->{$relation['name']}();

        if($model->{$relation['name']}){
            $id = $model->{$relation['name']}->id;
            $relationship->detach([$id]);
        }

        //
        $relationship->attach(request($relation['name']));
    }

    //
    static function detach($model, $relation = [])
    {
        $relationship = $model->{$relation['name']}();

        if($model->{$relation['name']}){
            $id = $model->{$relation['name']}->id;
            $relationship->detach([$id]);
        }
    }

    //
    static function addFormField($form, $field)
    {
        $width = isset($field['width']) ? $field['width'] : 6;

        //
        $form->addSelect($field['name'], $field['title'])
             ->setOptions($field['type_model']::where('relation_id', $field['id'])->get())
             ->setRelationKey('id')
             ->setWidth($width);
    }
}
