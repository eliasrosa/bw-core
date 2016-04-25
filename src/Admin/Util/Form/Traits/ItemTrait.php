<?php

namespace BW\Admin\Util\Form\Traits;

use BW\Admin\Util\Form\Item;

trait ItemTrait
{
    //
    public $itens = [];

    //
    public function __call($method, $args) {

        if(substr($method, 0, 3) == 'add'){
            $name_class = substr($method, 3);
            $item = $this->addItem($name_class, $args);

            return $item;
        }

        return false;
    }

    //
    private function addItem($name_class, $args)
    {
        //
        $config_class = config('bw.form.field.' . $name_class, false);

        if($config_class){
            $item_class = $config_class;
        }else{
            $item_class = $name_class;
        }

        //
        $item_obj = new $item_class($args, $this->model);

        //
        if (!$item_obj instanceof Item) {
            throw new \InvalidArgumentException('Third argument («type») must point to class inherited Item class');
        }

        // add obj in itens
        $this->itens[] = $item_obj;

        // obj
        return $item_obj;
    }

    //
    public function hasItens()
    {
        return (bool) count($this->itens);
    }
}
