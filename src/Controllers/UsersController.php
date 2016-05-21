<?php

namespace BW\Controllers;

use Validator;
use BW\Models\User;
use BW\Forms\UserForm;
use Illuminate\Http\Request;
use BW\Util\DataGrid\DataGrid;
use BW\Controllers\BaseController;

class UsersController extends BaseController
{

    //
    public function index(){

        //
        $filter = \DataFilter::source(\DB::table('users'));
        $filter->add('name','Nome', 'text');
        $filter->add('email','E-mail', 'text');
        $filter->submit('Pesquisar');
        $filter->reset('Limpar');
        $filter->build();

        //
        $grid = DataGrid::source($filter);
        $grid->add('id', 'ID', true);
        $grid->add('name', 'Nome', true);
        $grid->add('email', 'E-mail', true);
        $grid->addStatus();
        $grid->addOptions('bw.users.edit', 'bw.users.destroy');
        $grid->orderBy('id','desc');

        //
        return $this->view('users.index')
            ->with([
                'grid' => $grid->build(),
                'filter' => $filter,
             ]
        );
    }

    //
    public function create(){

        //
        $form = new UserForm();
        //
        return $this->view('users.create')
            ->with(compact('form'));
    }

    //
    public function store(Request $request){

        $validator = \Validator::make($request->all(), [
            'status'   => 'boolean',
            'name'     => 'required',
            'password' => 'required|confirmed|min:8',
            'email'    => 'required|email|unique:users',
        ]);

        //
        if ($validator->fails()) {

            $this->flash()->error('Alguns campos não foram preenchidos corretamente');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //
        $u = new User();
        $u->name = $request->get('name');
        $u->email = $request->get('email');
        $u->password = bcrypt($request->get('password'));
        $u->status = $request->get('status', false);
        $u->save();

        //
        $this->flash()->success('Usuário adicionado com sucesso!');
        return redirect()->route('bw.users.index');
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

        $validator = \Validator::make($request->all(), [
            'status'   => 'boolean',
            'name'     => 'required',
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
        $u->name = $request->get('name');
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
        $u = User::find($id);
        $u->delete();

        // redirect
        $this->flash()->success('Usuário removido com sucesso!');
        return redirect()->route('bw.users.index');
    }

}
