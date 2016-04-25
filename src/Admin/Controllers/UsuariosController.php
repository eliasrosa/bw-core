<?php

namespace BW\Admin\Controllers;

use Validator;
use Illuminate\Http\Request;
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
        $grid->add('opcoes', 'Opções')->cell(function($a, $b){

            $edit = sprintf('<a href="%s" class="btn btn-primary btn-sm">Editar</a>',
                route('bw.usuarios.edit', $b->id)
            );

            $remove = sprintf('<a href="%s" class="btn btn-danger btn-sm">Remover</a>',
                route('bw.usuarios.destroy', $b->id)
            );

            return $edit . ' ' . $remove;

        });
        $grid->orderBy('id','desc');

        //
        $menu = new Menu();
        $menu->add('Novo usuário', 'bw.usuarios.create');

        //
        return $this->view('usuarios.index')
            ->with([
                'grid' => $grid->build(),
                'filter' => $filter,
                'menu' => $menu->build(),
             ]
        );
    }

    private function form($method, $action, $source = null){

        $form = new Form($method, $action, $source);

        $form->addPanel('Dados do usuário', function($panel){
            $panel->addText('nome', 'Nome');
            $panel->addText('email', 'E-mail');
            $panel->addCheckboxActive('status', 'Status');
        });

        $form->addPanel('Dados de segurança', function($panel){
            $panel->addPassword('password', 'Senha');
        });

        return $form;
    }

    //
    public function create(){

        //
        $form = $this->form('post', route('bw.usuarios.store'));

        //
        return $this->view('usuarios.create')
            ->with(compact('form'));
    }

    //
    public function edit($id){

        //
        $form = $this->form('PUT', route('bw.usuarios.update', $id), Usuario::find($id));

        //
        return $this->view('usuarios.edit')
            ->with(compact('form'));
    }


    //
    public function store(Request $request){

        $validator = \Validator::make($request->all(), [
            'status'   => 'boolean',
            'nome'     => 'required',
            'password' => 'required|confirmed|min:8',
            'email'    => 'required|email|unique:bw_usuarios,email',
        ]);

        //
        if ($validator->fails()) {

            $this->flash()->error('Alguns campos não foram preenchidos corretamente');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $u = new Usuario();
        $u->nome = $request->get('nome');
        $u->email = $request->get('email');
        $u->password = bcrypt($request->get('password'));
        $u->status = $request->get('status', false);
        $u->save();

        //
        $this->flash()->success('Usuário adicionado com sucesso!');

        //
        return redirect()->route('bw.usuarios.index');
    }

}
