<?php

namespace BW\Admin\Forms;

use BW\Admin\Models\Usuario;
use BW\Admin\Util\Form\Form;

class UsuarioForm extends Form
{

    public function __construct($id = 0){

        if($id){
            parent::__construct('PUT', route('bw.usuarios.update', $id), Usuario::find($id));
        }else{
            parent::__construct('post', route('bw.usuarios.store'));
        }

        //
        $this->createForm();
    }

    private function createForm()
    {
        $this->addPanel('Dados do usuário', function($panel){
            $panel->addText('nome', 'Nome');
            $panel->addText('email', 'E-mail');
            $panel->addCheckboxActive('status', 'Status');
        });

        $this->addPanel('Dados de segurança', function($panel){
            $panel->addPassword('password', 'Senha');
        });

        return $this;
    }
}
