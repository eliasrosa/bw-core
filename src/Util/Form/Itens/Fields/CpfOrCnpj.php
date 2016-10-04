<?php

namespace BW\Util\Form\Itens\Fields;

use BW\Helpers\Html;

class CpfOrCnpj extends Mask
{
    public $mask = '';
    public $placeholder = 'CPF ou CPNJ';

    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute('data-mask-cpforcnpj', 'true');

        //
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/mask/data.mask.cpforcnpj.js'));
    }
}
