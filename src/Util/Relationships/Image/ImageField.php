<?php

namespace BW\Util\Relationships\Image;

use BW\Helpers\Html;
use BW\Util\Form\Itens\Fields\Field;

class ImageField extends Field
{
    public $type = 'file';
    public $view = 'BW::util.relationships.image.field';

    //
    public $image = null;

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        Html::addCSS(asset('/packages/eliasrosa/bw-core/util/form/image.css'));
        Html::addJS(asset('/packages/eliasrosa/bw-core/util/form/image.js'));

        //
        $this->addAttribute('accept', 'image/jpeg, image/png, image/bmp');
        $this->addAttribute('style', 'border: none; padding: 0; margin-top: 10px;');
    }

    //
    public function getImageUrl($filter)
    {
        return $this->model->{$this->name}->getUrl($filter);
    }

    //
    public function getId()
    {
        return $this->model->{$this->name}->id;
    }

    //
    public function hasImage()
    {
        return (bool) $this->model->{$this->name};
    }
}
