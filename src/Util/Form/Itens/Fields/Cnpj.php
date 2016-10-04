<?php

namespace BW\Util\Form\Itens\Fields;

class Cnpj extends Mask
{
    public $mask = '00.000.000/0000-00';
    public $placeholder = '00.000.000/0000-00';
    public $reverse = true;
}
