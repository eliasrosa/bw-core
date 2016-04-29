<?php

namespace BW\Util\Form;

use BW\Helpers\Html;
use BW\Traits\HtmlTrait;

class Item
{
    //
    use HtmlTrait;

    //
    public $view = 'BW::util.form.item';
    public $model = null;

    //
    public function __construct(&$model)
    {
        //
        $this->model = $model;
    }

    //
    public function getView()
    {
        //
        return $this->view;
    }
}
