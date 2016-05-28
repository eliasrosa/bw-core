<?php

namespace BW\Controllers;

use Validator;
use BW\Models\UserGroup;
use BW\Models\UserGroupPermission;
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
        $grid->add('{{ $users->count() }}','Usuários');
        $grid->addBoolean('super_administrator', 'Administrador', 'Sim', 'Não');
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
        $group = new UserGroup();
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->super_administrator = $request->get('super_administrator', false);
        $group->status = $request->get('status', false);
        $group->save();

        //
        if(!$group->super_administrator){
            foreach ($request->get('permissions', []) as $permission) {
                $group->permissions()->create(['permission' => $permission]);
            }
        }

        //
        $this->flash()->success('Grupo adicionado com sucesso!');
        return redirect()->route('bw.users.groups.index');
    }

    //
    public function edit($id){

        //
        $form = new UserGroupForm($id);

        //
        return $this->view('users.groups.edit')
            ->with(compact('form'));
    }

    //
    public function update(Request $request){

        //
        $id = $request->get('id');

        //
        if($id == \Auth::user()->group_id){
            $this->flash()->error('Você não pode editar seu próprio grupo de usuário!');
            return back();
        }

        //
        $validator = \Validator::make($request->all(), [
            'name'                => 'required|unique:users_groups,name,' . $id,
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
        $group = UserGroup::find($id);
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->super_administrator = $request->get('super_administrator', false);
        $group->status = $request->get('status', false);
        $group->save();

        //
        $group->permissions()->delete();

        //
        if(!$group->super_administrator){
            foreach ($request->get('permissions', []) as $permission) {
                $group->permissions()->create(['permission' => $permission]);
            }
        }

        //
        $this->flash()->success('Grupo atualizado com sucesso!');
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
