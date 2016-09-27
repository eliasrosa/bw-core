<?php

namespace BW\Controllers;

use Validator;
use BW\Models\UserGroup;
use Illuminate\Http\Request;
use BW\Models\UserGroupPermission;
use BW\Controllers\BaseController;
use BW\Views\Forms\Users\UserGroupForm;

class UsersGroupsController extends BaseController
{
    //
    public function index(){

        //
        $grupos = UserGroup::with('users')->get();

        //
        return $this->view('users.groups.index')->with('grupos', $grupos);
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
