<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field\Checkbox;

class CheckboxActive extends Checkbox
{
    public function __construct($name, $label, &$model = null)
    {
        parent::__construct($name, $label, $model);

        $this->setStatus('Ativado', 'Desativado');
    }

}
