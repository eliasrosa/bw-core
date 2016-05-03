<?php

namespace BW\Controllers\Auth;

use Eliasrosa\SafeValue;
use BW\Models\User;
use Illuminate\Http\Request;
use BW\Controllers\BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ResetPasswordController extends BaseController
{
    use ValidatesRequests;

    public function getReset($token = false)
    {
        if(!$token || !$this->getUsuarioByToken($token)){
            $token = false;
        }

        return $this->view('login.reset')
            ->with('token', $token);
    }

    public function postReset(Request $request)
    {
        //
        $usuario = $this->getUsuarioByToken($request->input('token'));

        if(!$usuario){
            return $this->getReset($request->input('token'));
        }

        $this->validate($request, [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        //
        $this->resetPassword($usuario, $request->input('password'));

        //
        return redirect()->route('bw.login.index')
            ->with([
                'mensagem' => 'Sua senha foi alterada com sucesso!',
                'mensagem_tipo' => 'success'
        ]);
    }

    protected function getUsuarioByToken($token){
        $safevalue = new SafeValue();
        $safevalue->setCustomKey(env('APP_KEY', null));
        $safevalue->setTimeExpire(config('auth.email.remember.expire'));
        $usuario_id = $safevalue->decode($token);

        if($usuario_id){

            return Usuario::where('id', $usuario_id)
                ->where('status', 1)
                ->first();
        }

        return false;
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }
}
