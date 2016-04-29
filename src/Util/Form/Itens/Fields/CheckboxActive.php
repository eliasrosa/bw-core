<?php

namespace BW\Util\Form\Itens\Fields;

class CheckboxActive extends Checkbox
{
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->setStatus('Ativado', 'Desativado');
    }

}
