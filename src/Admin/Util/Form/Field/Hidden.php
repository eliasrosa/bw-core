<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field;

class Hidden extends Field
{
    public $type = 'hidden';
    public $view = 'BW::util.form.field.hidden';

    public function __construct($name, $model)
    {
        parent::__construct($name, null, $model);
    }
}
