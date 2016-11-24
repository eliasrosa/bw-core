<?php

namespace BW\Util\Relationships\Image;

use BW\Helpers\Html;
use BW\Util\Form\Itens\Fields\Field;

class ImageField extends Field
{
    public $type = 'file';
    public $view = 'BW::util.relationships.image.field';
    public $relation = [];
    public $ref_id = 0;

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/fileupload-9.14.0/jquery.ui.widget.js'));
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/fileupload-9.14.0/jquery.iframe-transport.js'));
        Html::addJS(asset('/packages/eliasrosa/bw-core/vendor/fileupload-9.14.0/jquery.fileupload.js'));

        //
        Html::addCSS(asset('/packages/eliasrosa/bw-core/util/relationships/image/image.css'));
        Html::addJS(asset('/packages/eliasrosa/bw-core/util/relationships/image/image.js'));

        //
        $this->ref_id = isset($model->id) ? $model->id : 0;;
    }

    //
    public function setRelation($relation)
    {
        return $this->relation = $relation;
    }

    //
    public function getRefId()
    {
        return $this->ref_id;
    }
}
