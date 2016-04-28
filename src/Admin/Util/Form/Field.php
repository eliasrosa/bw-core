<?php

namespace BW\Admin\Util\Form;

class Field extends Item
{
    public $name = '';
    public $label = '';
    public $value = '';
    public $type = 'text';
    public $static = false;
    public $help_block = '';

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

}
