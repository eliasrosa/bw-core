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
            $panel->addText('name', 'Nome do grupo');
            $panel->addCheckboxActive('status', 'Status')->width = 6;
            $panel->addCheckbox('super_administrator', 'Permissão total')->width = 6;
        });

        $this->addPanel('Descrição do grupo', function($panel){
            $panel->addTextArea('description', 'Descrição')->addAttribute('style', 'height: 118px;');
        });

        $this->addPanel('Permissões de acesso', function($panel){
            $panel->width = 12;

            foreach (\Route::getRoutes() as $route) {
                if($route->getName()){
                    if(isset($route->getAction()['middleware'])){
                        if(in_array('bw.aclroutes', $route->getAction()['middleware'])){
                            $panel->addCheckbox($route->getName(), $route->getName())->width = 3;
                        }
                    }
                }
            }

        });

        return $this;
    }
}
