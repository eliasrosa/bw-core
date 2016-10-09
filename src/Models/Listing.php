<?php

namespace BW\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\MorphOneToMany;
use BW\Util\Relationships\Traits\RelationshipTrait;

class Listing extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'listings';
    protected $fillable = [];

    //
    static function getRelationship($model, $relation = array())
    {
        $related = get_class();
        $instance = new $related;

        return new MorphOneToMany(
            $instance->newQuery(), $model, 'listable', 'listings_rel',
            'listable_id', 'list_id', 'ref', false, $relation['id']
        );
    }

    //
    static function attachRelationships($model, $relation)
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
    static function detachRelationships($model, $relation)
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
             ->setOptions($field['type']::where('relation_id', $field['id'])->get())
             ->setRelationKey('id')
             ->setWidth($width);
    }

    // IMPORTANTE
    // O comando \BW\Models\Listing::with('ref') não está funcionando
    public function ref()
    {
        $relation = \BWAdmin::get('relationships')->get($this->relation_id)->first();

        $instance = new $relation['model'];
        return new MorphOneToMany(
            $instance->newQuery(), $this, 'listable', 'listings_rel',
            'list_id', 'listable_id', 'ref', true, $this->relation_id
        );
    }

}
