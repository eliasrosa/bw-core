<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field;

class Hidden extends Field
{
    public $type = 'hidden';
    public $view = 'BW::util.form.field.hidden';

    public function __construct($args, &$model)
    {
        //
        $this->name = $args[0];

        //
        $this->model = $model;
    }


}
