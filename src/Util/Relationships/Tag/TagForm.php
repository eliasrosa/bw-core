<?php

namespace BW\Util\Relationships\Tag;

use BW\Util\Form\Form;
use BW\Util\Relationships\Tag\Models\Tag;

class TagForm extends Form
{

    public function __construct($id = 0){

        //
        $relation_id = request('relation_id');

        //
        if($id){
            parent::__construct('PUT', route('bw.relationships.tag.update', $id), Tag::find($id));
        }else{
            parent::__construct('post', route('bw.relationships.tag.store'));
        }

        //
        $this->createForm();

        //
        $this->createPanelsRelationships(Tag::getModel(), $relation_id);
    }

    private function createForm()
    {
        //
        $relation = $this->getRelation();

        //
        $this->addHidden('relation_id')->setValue($relation['id']);

        //
        $this->addPanel('Dados', function($panel){
            $panel->addText('name', 'Nome');
            $panel->addTextArea('description', 'Descrição')
                  ->addAttribute('style', 'height: 120px;');
        });
    }

    //
    private function getRelation()
    {
        return \BWAdmin::get('relationships')->get()
            ->where('id', request('relation_id'))
            ->first();
    }
}

