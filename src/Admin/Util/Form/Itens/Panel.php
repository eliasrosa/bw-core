<?php

namespace BW\Admin\Util\Form\Itens;

use BW\Admin\Util\Form\Item;
use BW\Admin\Traits\HtmlTrait;
use BW\Admin\Util\Form\Traits\ItemTrait;

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
    public function __construct($args, &$model)
    {
        parent::__construct($model);

        //
        list($this->title, $itens_group) = $args;

        //
        $itens_group($this);
    }

}
