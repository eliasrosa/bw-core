<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Helpers\Html;
use BW\Admin\Util\Form\Field;

class Form
{
    //
    public $fields_static = false;
    public $group_id = 0;
    public $groups = [];
    public $model;
    public $attributes = [
        'method' => 'POST'
    ];

    //
    public function __construct($source = null)
    {
        if (is_object($source) && is_a($source, "\Illuminate\Database\Eloquent\Model")) {
            $this->model = $source;
        }
    }

    //
    public function setAction($route)
    {
        $this->addAttribute('action', $route);

        return $this;
    }

    //
    public function setMethod($method)
    {
        // GET', 'HEAD', 'PUT', 'PATCH', 'DELETE
        switch (strtoupper($method)) {
            case 'PUT':
                //$this->add('_method', null, 'Hidden')->setValue('PUT');
                $this->addAttribute('method', 'POST');
                break;

             case 'PATCH':
                //$this->add('_method', null, 'Hidden')->setValue('PATCH');
                $this->addAttribute('method', 'POST');
                break;

             case 'DELETE':
                //$this->add('_method', null, 'Hidden')->setValue('DELETE');
                $this->addAttribute('method', 'POST');
                break;
        }

        return $this;
    }

    //
    public function addGroup($callback, $title = null, $col = 6, $class = 'default')
    {
        // create
        $group = new \stdClass();
        $group->fields = [];
        $group->title = $title;
        $group->class = $class;
        $group->col = $col;
        $this->groups[$this->group_id] = $group;

        // run fields add
        $callback();

        // next group
        $this->group_id++;
    }

    //
    public function add($name, $label, $type)
    {
        //
        $config_class = config('bw.form.field.' . $type, false);

        if($config_class){
            $field_class = $config_class;
        }else{
            $field_class = $type;
        }

        //instancing
        if (isset($this->model)) {
            $field_obj = new $field_class($name, $label, $this->model);
        } else {
            $field_obj = new $field_class($name, $label);
        }

        //
        if (!$field_obj instanceof Field) {
            throw new \InvalidArgumentException('Third argument («type») must point to class inherited Field class');
        }

        // is upload
        if ($field_obj->type == "file") {
            $this->addAttribute([
                'enctype' => 'multipart/form-data',
                'method'  => 'POST'
            ]);
        }

        // is static
        $field_obj->static = $this->fields_static;

        // add field in group
        $this->groups[$this->group_id]->fields[] = $field_obj;

        // return obj
        return $field_obj;
    }

    //
    public function field($field_name)
    {
        foreach ($this->groups as $group) {
            foreach ($groups->fields as $name => $field_obj) {
                if ($name == $field_name) {
                    return $field_obj;
                }
            }
        }

        return false;
    }

    //
    public function addAttribute($attr, $value = '')
    {
        if(is_array($attr)){
            $this->attributes = array_merge($this->attributes, $attr);
        }else{
            $this->attributes[$attr] = $value;
        }

        return $this;
    }

    //
    public function getAttributes()
    {
        return Html::buildAttributes($this->attributes);
    }

}
