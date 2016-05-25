<?php

namespace BW\Controllers;

use Validator;
use BW\Models\UserGroup;
use BW\Forms\UserGroupForm;
use Illuminate\Http\Request;
use BW\Util\DataGrid\DataGrid;
use BW\Controllers\BaseController;

class UsersGroupsController extends BaseController
{

    //
    public function index(){

        //
        $filter = \DataFilter::source(UserGroup::with('users'));
        $filter->add('name','Nome', 'text');
        $filter->add('description','Descrição', 'text');
        $filter->submit('Pesquisar');
        $filter->reset('Limpar');
        $filter->build();

        //
        $grid = DataGrid::source($filter);
        $grid->add('id', 'ID', true);
        $grid->add('name', 'Nome', true);
        $grid->add('description','Descrição');
        $grid->add('{{ $users->count() }}','Usuários relacionados');
        $grid->addStatus();
        $grid->addOptions('bw.users.groups.edit', 'bw.users.groups.destroy');
        $grid->orderBy('id','desc');

        //
        return $this->view('users.groups.index')
            ->with([
                'grid' => $grid->build(),
                'filter' => $filter,
             ]
        );
    }

    //
    public function create(){

        //
        $form = new UserGroupForm();
        //
        return $this->view('users.groups.create')
            ->with(compact('form'));
    }

    //
    public function store(Request $request){

        $validator = \Validator::make($request->all(), [
            'name'                => 'required|unique:users_groups',
            'status'              => 'boolean',
            'super_administrator' => 'boolean',
            'description'         => 'required',
        ]);

        //
        if ($validator->fails()) {
            $this->flash()->error('Alguns campos não foram preenchidos corretamente');
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $u = new UserGroup();
        $u->name = $request->get('name');
        $u->description = $request->get('description');
        $u->super_administrator = $request->get('super_administrator', false);
        $u->status = $request->get('status', false);
        $u->save();

        //
        $this->flash()->success('Grupo adicionado com sucesso!');
        return redirect()->route('bw.users.groups.index');
    }

    //
    public function edit($id){

        //
        $form = new UserForm($id);

        //
        return $this->view('users.edit')
            ->with(compact('form'));
    }

    //
    public function update(Request $request){

        //
        if($id == \Auth::user()->group_id){
            $this->flash()->error('Você não pode remover seu próprio grupo de usuário!');
            return back();
        }

        //
        $validator = \Validator::make($request->all(), [
            'status'   => 'boolean',
            'nome'     => 'required',
            'password' => 'confirmed|min:8',
            'email'    => 'required|email|unique:users,email,' . $request->get('id'),
        ]);

        //
        if ($validator->fails()) {

            $this->flash()->error('Alguns campos não foram preenchidos corretamente');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $u = User::find($request->get('id'));
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
        $group = UserGroup::find($id);

        //
        if($group->users()->count()){
            $this->flash()->error('Você não pode remover grupos com usuários relacionados a eles!');
            return back();
        }

        // delete
        $group->delete();

        // redirect
        $this->flash()->success('Grupo removido com sucesso!');
        return redirect()->route('bw.users.groups.index');
    }

}
