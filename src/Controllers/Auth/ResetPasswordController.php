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
        if(!$token || !$this->getUserByToken($token)){
            $token = false;
        }

        return $this->view('login.reset')
            ->with('token', $token);
    }

    public function postReset(Request $request)
    {
        //
        $user = $this->getUserByToken($request->input('token'));

        if(!$user){
            return $this->getReset($request->input('token'));
        }

        $this->validate($request, [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        //
        $this->resetPassword($user, $request->input('password'));

        //
        return redirect()->route('bw.login.index')
            ->with([
                'mensagem' => 'Sua senha foi alterada com sucesso!',
                'mensagem_tipo' => 'success'
        ]);
    }

    protected function getUserByToken($token){
        $safevalue = new SafeValue();
        $safevalue->setCustomKey(env('APP_KEY', null));
        $safevalue->setTimeExpire(config('auth.email.remember.expire'));
        $user_id = $safevalue->decode($token);

        if($user_id){

            return User::where('id', $user_id)
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
