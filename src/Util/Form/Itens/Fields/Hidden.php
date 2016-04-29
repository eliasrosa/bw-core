<?php

namespace BW\Util\Form\Itens\Fields;

class Hidden extends Field
{
    public $type = 'hidden';
    public $view = 'BW::util.form.itens.fields.hidden';

    public function __construct($name, $model)
    {
        parent::__construct($name, null, $model);
    }
}
