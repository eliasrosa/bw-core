<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field;

class Password extends Field
{
    public $type = 'password';
    public $view = 'BW::util.form.field.password';
    public $attributes = [
        'placeholder' => 'Senha',
        'class' => 'form-control'
    ];
}
