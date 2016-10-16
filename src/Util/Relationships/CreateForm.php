<?php

namespace BW\Util\Relationships;

use BWAdmin;

class CreateForm
{
    private $form;
    private $model;

    public function __construct($form, $model, $parent_id = null)
    {
        $this->form = $form;
        $this->model = $model;
        $this->parent_id = $parent_id;
        $this->relations = $this->getRelations();

        //
        $this->createPanels();
    }

    private function getRelations()
    {
        return BWAdmin::get('relationships')
            ->get()
            ->where('model', get_class($this->model))
            ->where('parent', $this->parent_id)
            ->groupBy('panel');
    }

    private function createPanels()
    {
        $this->relations->each(function($fields, $panel_title) {
            $this->form->addPanel($panel_title, function($panel) use($fields){

                //
                $fields->each(function($field) use ($panel){
                    $field['type']::addFormField($panel, $field);
                });
            });
        });
    }
}
