<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Helpers\Html;
use BW\Admin\Util\Form\Field;

class Form
{
    //
    public $fields_static = false;
    public $fields = [];
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

        //
        if ($field_obj->type == "file") {
            $this->multipart = true;
        }

        // is static
        $field_obj->static = $this->fields_static;

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
    public function getAttributes()
    {
        return Html::buildAttributes($this->attributes);
    }

}
