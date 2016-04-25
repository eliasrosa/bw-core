<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field\Checkbox;

class CheckboxActive extends Checkbox
{
    public function __construct($args, &$model)
    {
        //
        parent::__construct($args, $model);

        //
        $this->setStatus('Ativado', 'Desativado');
    }

}
