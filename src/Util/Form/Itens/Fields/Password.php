<?php

namespace BW\Util\Form\Itens\Fields;

class Password extends Field
{
    public $type = 'password';
    public $view = 'BW::util.form.itens.fields.password';

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->addAttribute('placeholder', 'Senha');
    }
}
