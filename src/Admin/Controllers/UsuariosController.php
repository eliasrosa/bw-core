<?php

namespace BW\Admin\Controllers;

use BW\Admin\Util\Menu\Menu;
use BW\Admin\Util\Form\Form;
use BW\Admin\Models\Usuario;
use BW\Admin\Util\DataGrid\DataGrid;
use BW\Admin\Controllers\BaseController;

class UsuariosController extends BaseController
{

    //
    public function index(){

        //
        $filter = \DataFilter::source(\DB::table('bw_usuarios'));
        $filter->add('nome','Nome', 'text');
        $filter->submit('Pesquisar');
        $filter->reset('Limpar');
        $filter->build();

        //
        $grid = DataGrid::source($filter);
        $grid->add('id', 'ID', true);
        $grid->add('nome', 'Nome', true);
        $grid->add('email', 'E-mail', true);
        $grid->add('status', 'Status', true);
        $grid->orderBy('id','desc');

        //
        $menu = new Menu();
        $menu->add('Novo usuário', 'bw.usuarios.create');

        //
        return $this->view('usuarios.index')
            ->with([
                'grid' => $grid->build(),
                'filter' => $filter,
                'menu' => $menu->build()
             ]
        );
    }


    //
    public function create(){

        $form = new Form(Usuario::find(1));

        $form->addGroup(function() use ($form){
            $form->add('nome', 'Nome', 'Text')
                ->setHelpBlock('Seu nome é muito importante!');

            $form->add('nome2', 'Nome2', 'Text');
            $form->add('usuario', 'Usuário', 'Text');
        }, 'Dados iniciais');

        $form->addGroup(function() use ($form){
            $form->add('apelido', 'Apelido', 'Text');
            $form->add('ref', 'Referencia', 'Text');
        }, 'Painel 2');

        $form->addGroup(function() use ($form){
            $form->add('foto', 'Foto', 'File');
            $form->add('senha1', 'Senha', 'Password');
            $form->add('senha2', 'Senha de operador', 'Password');
        }, 'Painel 3', 12);


        //
        return $this->view('usuarios.create')->with(compact('form'));
    }

}
