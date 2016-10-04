<?php

namespace BW\Util\Form\Itens\Fields;

class Currency extends Mask
{
    public $symbol = 'R$';
    public $mask = '#.##0,00';
    public $placeholder = '0,00';
    public $reverse = true;
    public $view = 'BW::util.form.itens.fields.currency';

    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute([
            'style' => 'text-align: right;'
        ]);
    }

}
