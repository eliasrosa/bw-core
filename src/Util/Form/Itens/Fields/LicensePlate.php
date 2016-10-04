<?php

namespace BW\Util\Form\Itens\Fields;

class LicensePlate extends Mask
{
    public $mask = 'SSS-0000';
    public $placeholder = 'XXX-0000';


    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute([
            'style' => 'text-transform: uppercase;'
        ]);
    }
}
