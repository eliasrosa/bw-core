<?php

namespace BW\Forms;

use BW\Models\User;
use BW\Util\Form\Form;

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
            $panel->addCheckboxActive('status', 'Status');
        });

        $this->addPanel('Dados de segurança', function($panel){
            $panel->addPassword('password', 'Senha');
        });

        return $this;
    }
}
