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
            $ignore_routes = config('bw.middleware.aclroutes.ignore_routes', []);

            foreach (\Route::getRoutes() as $route) {
                if($route->getName()){
                    if(!in_array($route->getName(), $ignore_routes)){
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
            }

            //
            if(count(old())){
                foreach (old('permissions', []) as $i) {
                    $permissions[$i]['checked'] = 'checked';
                };
            }else{
                if($this->model){
                    $erros = [];
                    foreach ($this->model->permissions as $i) {
                        if(isset($permissions[$i->permission])){
                            $permissions[$i->permission]['checked'] = 'checked';
                        }else{
                            $erros[] = '- ' . $i->permission;
                        }
                    };

                    if(count($erros)){
                        $msg = 'As seguinte permissões não existem mais e serão removidas ao salvar o grupo<br><br>' . join('<br>', $erros);
                        app('flash')->warning($msg);
                    }
                }
            }

            //
            $panel->width = 12;
            $panel->addIncludeFile('BW::users.groups.permissions', $permissions);
        });

        return $this;
    }
}
