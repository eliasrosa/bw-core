<?php

namespace BW\Util\Form\Itens\Fields;

use BW\Util\Form\Item;

class Field extends Item
{
    public $name = '';
    public $label = '';
    public $value = '';
    public $type = 'text';
    public $static = false;
    public $help_block = '';
    public $width = 12;

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($model);

        //
        $this->addAttribute([
            'class' => 'form-control'
        ]);

        //
        $this->name = $name;
        $this->label = $label;
    }

    //
    public function getValue()
    {
        if($this->name != '' && $this->model && isset($this->model->{$this->name})){
            $this->value = $this->model->{$this->name};
        }

        //
        if(isset($this->model)){
            if(strpos($this->name, '.')){
                list($relation_model, $name) = explode('.', $this->name);
                if(is_object($this->model->{$relation_model})){
                    $obj = $this->model->{$relation_model};
                    $this->value = $obj->{$name};
                }
            }
        }

        return old($this->name, $this->value);
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
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    //
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
}
