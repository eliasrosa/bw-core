<?php

namespace BW\Util\Form\Itens\Fields;

use BW\Helpers\Html;

class Mask extends Field
{
    //
    // http://igorescobar.github.io/jQuery-Mask-Plugin/

    //
    public $type = 'mask';
    public $view = 'BW::util.form.itens.fields.mask';
    public $width = 6;
    public $mask = '';
    public $placeholder = '-- maks not defined --';
    public $reverse = false;

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute([
            'data-mask-clearifnotmatch' => 'true',
            'data-mask-reverse' => $this->reverse ? 'true' : 'false',
        ]);

        //
        $this->setMask($this->mask, $this->placeholder);

        //
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/mask/jquery.mask.min.js'));
    }

    public function setMask($mask, $placeholder)
    {
        $this->addAttribute([
            'data-mask' => $mask,
            'placeholder' => $placeholder,
        ]);
    }

}
