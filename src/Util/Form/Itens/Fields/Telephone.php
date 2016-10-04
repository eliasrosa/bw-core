<?php

namespace BW\Util\Form\Itens\Fields;

use BW\Helpers\Html;

class Telephone extends Mask
{
    public $mask = '';
    public $placeholder = '(00) 00000-0000';

    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute('data-mask-telephone', 'true');

        //
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/mask/data.mask.telephone.js'));
    }
}
