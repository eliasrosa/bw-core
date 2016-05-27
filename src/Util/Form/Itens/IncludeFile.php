<?php

namespace BW\Util\Form\Itens;

use BW\Util\Form\Item;

class IncludeFile extends Item
{
    //
    public $view = '';
    public $params = '';

    //
    public function __construct($view, $params = null, $model = null)
    {
        parent::__construct($model);

        //
        $this->view = $view;
        $this->params = $params;
    }

}
