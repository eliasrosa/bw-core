<?php

namespace BW\Views\Forms\Users;

use BW\Models\User;
use BW\Util\Form\Form;
use BW\Models\UserGroup;

class UserForm extends Form
{

    public function __construct($id = 0){

        if($id){
            parent::__construct('PUT', route('bw.users.update', $id), User::find($id));
        }else{
            parent::__construct('post', route('bw.users.store'));
        }

        //
        $this->createForm();
    }

    private function createForm()
    {
        $this->addPanel('Dados do usuário', function($panel){
            $panel->addText('name', 'Nome');
            $panel->addText('email', 'E-mail');
            $panel->addSelect('group_id', 'Grupo')
                  ->setOptions(UserGroup::get());
        });

        $this->addPanel('Dados de segurança', function($panel){
            $panel->addPassword('password', 'Senha');
            $panel->addCheckboxActive('status', 'Status');
        });

        return $this;
    }
}
