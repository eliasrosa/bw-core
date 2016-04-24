<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Helpers\Html;

class Field
{
    public $view = 'BW::util.form.field';
    public $type = 'field';
    public $name = '';
    public $label = '';
    public $value = '';
    public $model;
    public $static = false;
    public $help_block = '';
    public $attributes = [
        'class' => 'form-control'
    ];

    //
    public function __construct($name, $label, &$model = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->model = $model;
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

    //
    public function setHelpBlock($value)
    {
        $this->help_block = $value;

        return $this;
    }

    //
    public function setStatic($value)
    {
        $this->static = $value;

        return $this;
    }

    //
    public function getValue()
    {
        if($this->model && isset($this->model->{$this->name})){
            $this->value = $this->model->{$this->name};
        }

        return old($this->name, $this->value);
    }
}
