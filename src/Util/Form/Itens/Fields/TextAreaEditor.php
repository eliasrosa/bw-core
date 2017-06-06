<?php

namespace BW\Util\Form\Itens\Fields;

use BW\Helpers\Html;

class TextAreaEditor extends Field
{
    public $view = 'BW::util.form.itens.fields.textarea_editor';

    //
    public function __construct($name, $label, $model)
    {
        //
        parent::__construct($name, $label, $model);

        //
        $path = '/packages/eliasrosa/bw-core';

        //
        $this->addAttribute([
        	'id' => $name,
        	'data-icons-url' => asset($path . '/vendor/NicEdit0.9-r25/nicEditorIcons.gif'),
        	'style' => 'height: 200px;',
        ]);

        //
        Html::addCSS('https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css');
        Html::addJS('https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js');
        Html::addJS(asset($path . '/vendor/NicEdit0.9-r25/nicEdit.js'));
        Html::addJS(asset($path . '/util/form/textarea-editor.js'));
    }


    public function getEditorType()
    {
        if(isset($this->model)){
            return $this->model->getParametersTextarea($this->name)['type'];
        }

        return 'simple-text';
    }

}
