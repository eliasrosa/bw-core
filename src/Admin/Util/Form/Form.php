<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Traits\HtmlTrait;
use BW\Admin\Util\Form\Traits\ItemTrait;

class Form
{
    // Trait's
    use ItemTrait, HtmlTrait;

    //
    public $model = null;

    //
    public function __construct($method, $action, $source = null)
    {
        //
        if (is_object($source) && is_a($source, "\Illuminate\Database\Eloquent\Model")) {
            $this->model = $source;
        }

        //
        $this->setMethod($method);
        $this->setAction($action);
    }

    //
    public function setAction($route)
    {
        $this->addAttribute('action', $route);
        return $this;
    }

    //
    public function setMethod($method)
    {
        //
        $this->addAttribute('method', 'POST');
        $this->addHidden('_method')->setValue($method);

        //
        if(!is_null($this->model) && ($method == 'PUT' OR $method == 'PATCH' OR $method == 'DELETE')){
            $this->addHidden('id')->setValue($this->model->id);
        }

        //
        return $this;
    }
}
