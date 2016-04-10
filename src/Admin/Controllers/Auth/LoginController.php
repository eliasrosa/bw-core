<?php

namespace BW\Admin\Controllers\Auth;

use Illuminate\Http\Request;
use BW\Admin\Controllers\BaseController;

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
        if (\Auth::attempt(['email' => $email, 'password' => $password])) {
            $response = redirect()->route('bw.home');

            if($remember ===  '1'){
                $cookie = cookie()->forever('bw_login_remember', $email);
            }else{
                $cookie = cookie()->forget('bw_login_remember');
            }

            // set/remove cookie
            $response->withCookie($cookie);

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
