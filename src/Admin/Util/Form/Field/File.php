<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field;

class File extends Field
{
    public $type = 'file';
    public $view = 'BW::util.form.field.file';
    public $attributes = [
        'class' => ''
    ];
}
