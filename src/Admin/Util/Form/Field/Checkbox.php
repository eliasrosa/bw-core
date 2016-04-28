<?php

namespace BW\Admin\Util\Form\Field;

use BW\Admin\Util\Form\Field;
use BW\Admin\Helpers\Html;

class Checkbox extends Field
{
    //
    public $type = 'checkbox';
    public $view = 'BW::util.form.field.checkbox';

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute([
            'data-toggle' => 'toggle',
            'data-onstyle' => 'success',
            'data-offstyle' => 'danger',
            'data-on' => 'Sim',
            'data-off' => 'Não',
        ]);

        //
        Html::addCSS(asset('/packages/eliasrosa/bw-core/vendor/bootstrap-toggle/bootstrap-toggle.min.css'));
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/bootstrap-toggle/bootstrap-toggle.min.js'));

        //
        if((bool) $this->getValue()){
            $this->addAttribute('checked', null);
        }
    }

    //
    public function setStatus($text_on, $text_off)
    {
        $this->addAttribute([
            'data-on' => $text_on,
            'data-off' => $text_off,
        ]);

        return $this;
    }
}
