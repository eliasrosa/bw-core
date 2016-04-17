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

        $form = new Form(Usuario::find(2));
        $form->add('nome', 'Nome', 'text')
            ->addAttribute('placeholder', 'Seu nome')
            ->setHelpBlock('Seu nome é muito importante!');

        $form->add('usuario', 'Usuário', 'text')
            ->addAttribute('placeholder', 'Usuário');

        $form->add('email', 'E-mail', 'email')
            ->setStatic(true);

        $form->add('foto', 'Foto', 'file');
        $form->add('senha', 'Senha', 'password');
        $form->add('senha2', 'Senha de operador', 'password');

        $form->build();

        return $this->view('usuarios.create')->with([
            'form' => $form
        ]);

    }

}
