<?php

namespace BW\Util\Validation;

abstract class Validator
{

    static public function make($model, $form, $data, $rules, $messages = [], $customAttributes = [], $parent = null)
    {
        $relationships = \BWAdmin::get('relationships')
            ->get()
            ->where('model', $model)
            ->where('parent', $parent)
            ->filter(function($item){
                return !is_null($item['validator']);
            });

        //
        $relationships->each(function($relation) use(&$rules){
            $rules[$relation['name']] = $relation['validator'];
        });

        //
        $form = new $form();
        $attributes = array_merge($form->getValidatorAttributes(), $customAttributes);

        //
        return \Validator::make($data,  $rules, $messages, $attributes);
    }

}
