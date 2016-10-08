<?php

namespace BW\Util\Form\Itens\Fields;

class Select extends Field
{
    public $view = 'BW::util.form.itens.fields.select';

    //
    protected $options = [];

    //
    public function getOptions()
    {
        return $this->options;
    }

    //
    public function setOptions($collection, $key = 'id', $label = 'name')
    {
        $list = [];
        $list[0] = '-- Selecione --';

        foreach ($collection as $c) {
            $list[$c->$key] = $c->$label;
        }

        //
        $this->options = $list;

        //
        return $this;
    }
}
