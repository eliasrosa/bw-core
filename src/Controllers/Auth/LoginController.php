<?php

namespace BW\Controllers\Auth;

use Illuminate\Http\Request;
use BW\Controllers\BaseController;

class LoginController extends BaseController
{
    public function getLogin()
    {
        if (\Auth::check()) {
            return redirect()->route('bw.home');
        }

        return $this->view('login.index');
    }

    public function postLogin(Request $request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        //
        if (\Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {

            //
            $user = \Auth::user();
            if((bool) $user->group->status){

                $response = redirect()->route('bw.home');

                if($remember ===  '1'){
                    $cookie = cookie()->forever('bw_login_remember', $email);
                }else{
                    $cookie = cookie()->forget('bw_login_remember');
                }

            // set/remove cookie
            $response->withCookie($cookie);

            }else{
                \Auth::logout();

                $response = redirect()->route('bw.login.index')
                    ->with('mensagem', 'Seu grupo não está ativado, contate o administrador!')
                    ->withInput($request->except('password'));
            }

        }else{
            $response = redirect()->route('bw.login.index')
                ->with('mensagem', 'Usuário e/ou senha inválidos!')
                ->withInput($request->except('password'));
        }

        //
        return $response;
    }

    public function getLogout()
    {
        \Auth::logout();

        //
        return redirect()->route('bw.login.index');
    }


}
