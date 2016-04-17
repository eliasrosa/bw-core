<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Util\Form\Field;

class Form
{
    //
    public $view_tpl = 'BW::util.form.form';
    public $fields_static = false;
    public $fields = [];
    public $view;
    public $model;

    //
    protected $method = 'POST';

    //
    public function __construct($source = '')
    {
        if (is_object($source) && is_a($source, "\Illuminate\Database\Eloquent\Model")) {
            $this->model = $source;
        }
    }

    //
    public function add($name, $label, $type)
    {
        if (strpos($type, "\\") !== false) {
            $field_class = $type;
        } else {
            $field_class = '\BW\Admin\Util\Form\Field\\' .  ucfirst($type);
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

        //
        if ($field_obj->type == "file") {
            $this->multipart = true;
        }

        // is static
        $field_obj->is_static = $this->fields_static;

        // add array
        $this->fields[$name] = $field_obj;

        // return obj
        return $field_obj;
    }

    //
    public function remove($fieldname)
    {
        if (isset($this->fields[$fieldname]))
            unset($this->fields[$fieldname]);

        return $this;
    }

    //
    public function field($field_name)
    {
        if (isset($this->fields[$field_name])) {
            $field = $this->fields[$field_name];

            return $field;
        }

        return false;
    }

    //
    public function render($field_name = false)
    {
        // render this form
        if($field_name === false){
            return $this->renderForm();
        }

        $field = $this->field($field_name);
        return $field->render();
    }

    //
    public function renderForm()
    {
        return $this->view->render();
    }

    //
    public function buildFields()
    {
        foreach ($this->fields as $field_obj) {
            $field_obj->build();
        }
    }

    //
    public function build($view = '')
    {
        //
        $view = ($view != '') ? $view : $this->view_tpl;

        //
        $this->buildFields();

        //
        $this->view = view($view)->with([
            'fields' => $this->fields,
        ]);

        return $this->view;
    }


}
