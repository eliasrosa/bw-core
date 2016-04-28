<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Helpers\Html;
use BW\Admin\Traits\HtmlTrait;

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
