<?php

namespace BW\Controllers;

use Validator;
use Illuminate\Http\Request;
use BW\Util\Menu\Menu;
use BW\Models\Usuario;
use BW\Forms\UsuarioForm;
use BW\Util\DataGrid\DataGrid;
use BW\Controllers\BaseController;

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

            $remove = sprintf('<form action="%s" method="POST">' . csrf_field() .
                              '<input type="hidden" name="_method" value="DELETE">' .
                              '<input type="submit" class="btn btn-danger btn-sm" value="Remover">' .
                              '</form>', route('bw.usuarios.destroy', $b->id)
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

    //
    public function create(){

        //
        $form = new UsuarioForm();
        //
        return $this->view('usuarios.create')
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
        return redirect()->route('bw.usuarios.index');
    }

    //
    public function edit($id){

        //
        $form = new UsuarioForm($id);

        //
        return $this->view('usuarios.edit')
            ->with(compact('form'));
    }

    //
    public function update(Request $request){

        $validator = \Validator::make($request->all(), [
            'status'   => 'boolean',
            'nome'     => 'required',
            'password' => 'confirmed|min:8',
            'email'    => 'required|email|unique:bw_usuarios,email,' . $request->get('id'),
        ]);

        //
        if ($validator->fails()) {

            $this->flash()->error('Alguns campos não foram preenchidos corretamente');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $u = Usuario::find($request->get('id'));
        $u->nome = $request->get('nome');
        $u->email = $request->get('email');
        $u->status = $request->get('status', false);

        // update password
        if($request->get('password', false)){
            $u->password = bcrypt($request->get('password'));
        }

        //
        $u->save();

        //
        $this->flash()->success('Usuário atualizado com sucesso!');
        return back();
    }

    //
    public function destroy($id)
    {
        //
        if($id == \Auth::user()->id){
            $this->flash()->error('Você não pode remover seu próprio usuário!');
            return back();
        }

        // delete
        $u = Usuario::find($id);
        $u->delete();

        // redirect
        $this->flash()->success('Usuário removido com sucesso!');
        return redirect()->route('bw.usuarios.index');
    }

}
