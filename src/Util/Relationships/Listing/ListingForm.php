<?php

namespace BW\Util\Relationships\Listing;

use BW\Util\Form\Form;
use BW\Util\Relationships\Listing\Models\Listing;

class ListingForm extends Form
{

    public function __construct($id = 0){

        //
        $relation_id = request('relation_id');

        //
        if($id){
            parent::__construct('PUT', route('bw.relationships.listing.update', $id), Listing::find($id));
        }else{
            parent::__construct('post', route('bw.relationships.listing.store'));
        }

        //
        $this->createForm();

        //
        $this->createPanelsRelationships(Listing::getModel(), $relation_id);
    }

    private function createForm()
    {
        //
        $relation = $this->getRelation();

        //
        $this->addHidden('relation_id')->setValue($relation['id']);

        //
        $this->addPanel('Dados', function($panel){
            $panel->addText('name', 'Nome')
                  ->width = 6;
                  
            $panel->addInteger('position', 'Posição')
                  ->width = 6;
                  
            $panel->addTextArea('description', 'Descrição')
                  ->addAttribute('style', 'height: 120px;');
            //      
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

