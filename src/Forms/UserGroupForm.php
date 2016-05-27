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
            parent::__construct('POST', route('bw.users.groups.store'));
        }

        //
        $this->createForm();
    }

    private function createForm()
    {
        $this->addPanel('Dados do grupo de usuário', function($panel){
            $panel->addText('name', 'Nome do grupo');
            $panel->addCheckboxActive('status', 'Status')->width = 6;
            $panel->addCheckbox('super_administrator', 'Super Administrador')->width = 6;
        });

        $this->addPanel('Descrição do grupo', function($panel){
            $panel->addTextArea('description', 'Descrição')->addAttribute('style', 'height: 118px;');
        });

        $this->addPanel('Permissões de acesso', function($panel){
            $permissions = [];
            foreach (\Route::getRoutes() as $route) {
                if($route->getName() && $route->getName() != 'bw.home'){
                    $name = $route->getName();

                    if(isset($route->getAction()['middleware'])){
                        if(in_array('bw.aclroutes', $route->getAction()['middleware'])){
                            $url = str_replace('.', '/', str_replace('bw.' , '/', $name));
                            $permissions[$name] = [
                                'label' => $url,
                                'value' => $name,
                                'checked' => '',
                            ];
                        }
                    }
                }
            }

            //
            if(count(old())){
                foreach (old('permissions', []) as $i) {
                    $permissions[$i]['checked'] = 'checked';
                };
            }else{
                if($this->model){
                    foreach ($this->model->permissions as $i) {
                        $permissions[$i->permission]['checked'] = 'checked';
                    };
                }
            }

            //
            $panel->width = 12;
            $panel->addIncludeFile('BW::users.groups.permissions', $permissions);
        });

        return $this;
    }
}
