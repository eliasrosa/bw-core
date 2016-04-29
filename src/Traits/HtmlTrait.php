<?php

namespace BW\Traits;

use BW\Helpers\Html;

trait HtmlTrait
{
    //
    public $html_attributes = [];

    //
    public function addAttribute($attr, $value = '')
    {
        if(is_array($attr)){
            $this->html_attributes = array_merge($this->html_attributes, $attr);
        }else{
            $this->html_attributes[$attr] = $value;
        }

        return $this;
    }

    //
    public function buildAttributes()
    {
        return Html::buildAttributes($this->html_attributes);
    }
}
