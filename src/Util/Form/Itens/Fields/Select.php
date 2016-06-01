<?php

namespace BW\Util\Form\Itens\Fields;

class Select extends Field
{
    public $view = 'BW::util.form.itens.fields.select';

    //
    protected $options = [];

    //
    public function __construct($name, $label, $options = [], $model = null)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($collection, $key = 'id', $label = 'name')
    {
        $list = [];
        foreach ($collection as $c) {
            $list[$c->$key] = $c->$label;
        }

        //
        $this->options = $list;

        //
        return $this;
    }

}
