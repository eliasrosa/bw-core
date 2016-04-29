<?php

namespace BW\Util\Form\Itens;

use BW\Util\Form\Item;
use BW\Traits\HtmlTrait;
use BW\Util\Form\Traits\ItemTrait;

class Panel extends Item
{
    //
    use ItemTrait;

    //
    public $type = 'primary';
    public $width = 6;
    public $title = null;
    public $view = 'BW::util.form.itens.panel';

    //
    public function __construct($title, $function_call, $model)
    {
        parent::__construct($model);

        //
        $this->title = $title;

        //
        $function_call($this);
    }

}
