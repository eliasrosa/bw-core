<?php

namespace BW\Util\Relationships\Tag;

use BW\Helpers\Html;
use BW\Util\Relationships\RelationshipBase;

abstract class TagRelationship extends RelationshipBase
{
    //
    static $model = 'BW\Util\Relationships\Tag\Models\Tag';

    //
    static $manager_menu = true;
    static $manager_menu_icon = 'fa fa-check-square-o';
    static $manager_menu_title = 'Gerenciar marcadores';
    static $manager_menu_route = 'bw.relationships.tag.index';

    //
    static function getManagerRouterFile()
    {
        return __DIR__ . '/../../../../routes/admin-tag.php';
    }

    //
    static function addFormField($form, $field)
    {
        $title = isset($field['title']) ? $field['title'] : ucfirst($field['name']);
        $width = isset($field['width']) ? $field['width'] : 6;

        //
        Html::addCSS(asset('/packages/eliasrosa/bw-core/vendor/bootstrap-toggle/bootstrap-toggle.min.css'));
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/bootstrap-toggle/bootstrap-toggle.min.js'));

        $id = $form->model ? $form->model->id: 0;
        $tags = $field['type_model']::where('relation_id', $field['id'])
            ->with(['ref' => function($query) use($id){
                $query->where('id', '=', $id);
            }])->get();

        $form->addIncludeFile('BW::util.relationships.tag.list', [
            'field' => $field,
            'tags' => $tags,
        ]);
    }

    //
    static function getRelationship($model, $relation = array())
    {
        return $model->morphToMany(static::$model, 'taggable', 'tags_rel')
            ->withPivot('relation_id')
            ->wherePivot('relation_id', $relation['id']);
    }

    //
    static function attach($model, $relation = [])
    {
        $relationship = $model->{$relation['name']}();
        $request_data = request($relation['name'], []);

        $data_sync = array_map(function($i) use($relation){
            return ['relation_id' => $relation['id']];
        }, $request_data);

        // sync
        $relationship->sync($data_sync);
    }

    //
    static function detach($model, $relation = [])
    {
        $relationship = $model->{$relation['name']}();
        $relationship->detach();
    }    
}
