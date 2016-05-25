<?php

namespace BW\Forms;

use BW\Models\UserGroup as Model;
use BW\Util\Form\Form;

class UserGroupForm extends Form
{

    public function __construct($id = 0){

        if($id){
            parent::__construct('PUT', route('bw.users.groups.update', $id), Model::find($id));
        }else{
            parent::__construct('post', route('bw.users.groups.store'));
        }

        //
        $this->createForm();
    }

    private function createForm()
    {
        $this->addPanel('Dados do grupo de usuário', function($panel){
            $panel->addText('name', 'Nome');
            $panel->addCheckboxActive('status', 'Status');
        });

        $this->addPanel('Descrição do grupo', function($panel){
            $panel->addTextArea('description', 'Descrição');
        });

        $this->addPanel('Permissões de acesso', function($panel){
            $panel->width = 12;
            $panel->addCheckbox('super_administrator', 'Permissão total');
        });

        return $this;
    }
}
