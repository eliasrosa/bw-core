<?php

namespace BW\Util\Form;

use BW\Traits\HtmlTrait;
use BW\Util\Form\Traits\ItemTrait;
use BW\Util\Relationships\CreateForm;

class Form
{
    // Trait's
    use ItemTrait, HtmlTrait;

    //
    public $model = null;
    public $validator_attributes = [];

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
        $this->addAttribute([
            'method' => 'POST',
            'enctype' => 'multipart/form-data'
        ]);

        //
        $this->addHidden('_method')->setValue($method);

        //
        if(!is_null($this->model) && ($method == 'PUT' OR $method == 'PATCH' OR $method == 'DELETE')){
            $this->addHidden('id')->setValue($this->model->id);
        }

        //
        return $this;
    }

    //
    public function createPanelsRelationships($model, $parent_id = null)
    {
        return new CreateForm($this, $model, $parent_id);
    }

    //
    public function getValidatorAttributes($item = null)
    {
        if(is_null($item)){
            $item = $this;
        }

        if(isset($item->itens) && is_array($item->itens)){
            foreach ($item->itens as $key => $i) {
                if(isset($i->name) && isset($i->label)){
                    $this->validator_attributes[$i->name] = $i->label;
                }

                //
                $this->getValidatorAttributes($i);
            }
        }

        return $this->validator_attributes;
    }
}
