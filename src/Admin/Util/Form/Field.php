<?php

namespace BW\Admin\Util\Form;

class Field
{
    public $view;
    public $view_tpl = 'BW::util.form.field';
    public $name = '';
    public $label = '';
    public $value = '';
    public $type = 'field';
    public $help_block = '';
    public $is_static = false;
    public $model;
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
            $this->atributes = array_merge($this->atributes, $attr);
        }else{
            $this->atributes[$attr] = $value;
        }

        return $this;
    }

    //
    public function buildAttributes()
    {
        $html = '';
        foreach ($this->attributes as $key => $value) {
            $html .= sprintf(' %s="%s"', $key, $value);
        }

        return $html;
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
        $this->is_static = $value;

        return $this;
    }


    //
    public function render()
    {
        return $this->view->render();
    }

    //
    public function getValue()
    {
        if($this->model && isset($this->model->{$this->name})){
            $this->value = $this->model->{$this->name};
        }

        return $this->value;
    }


    //
    public function build($view = '')
    {
        //
        $view = ($view != '') ? $view : $this->view_tpl;

        //
        $this->view = view($view)->with([
            'name' => $this->name,
            'type' => $this->type,
            'label' => $this->label,
            'value' => $this->getValue(),
            'attributes' => $this->attributes,
            'attributes_html' => $this->buildAttributes(),
            'help_block' => $this->help_block,
            'is_static' => $this->is_static,
        ]);

        return $this->view;
    }
}
