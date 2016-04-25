<?php

namespace BW\Admin\Util\Form;

use BW\Admin\Traits\HtmlTrait;
use BW\Admin\Util\Form\Traits\ItemTrait;

class Form
{
    //
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
        // GET', 'HEAD', 'PUT', 'PATCH', 'DELETE
        switch (strtoupper($method)) {
            case 'POST':
                $this->addHidden('_method')->setValue('POST');
                $this->addAttribute('method', 'POST');
                break;

            case 'PUT':
                $this->addHidden('_method')->setValue('PUT');
                $this->addAttribute('method', 'POST');
                break;

             case 'PATCH':
                $this->addHidden('_method')->setValue('PATCH');
                $this->addAttribute('method', 'POST');
                break;

             case 'DELETE':
                $this->addHidden('_method')->setValue('DELETE');
                $this->addAttribute('method', 'POST');
                break;
        }

        //
        return $this;
    }
}
