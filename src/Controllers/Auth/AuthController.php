<?php

namespace BW\Controllers\Auth;

use Auth;
use View;
use Config;
use Cookie;
use Validator;
use BW\Mondels\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(config('bw.admin.url'));
        }

        return View::make(Config::get('bw.admin.views.login'));
    }

    public function logout()
    {
        Auth::logout();

        //
        return redirect(config('bw.admin.url') . '/login');
    }

    public function authenticate(Request $request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        //
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $response = redirect(config('bw.admin.url'));

            if($remember ===  '1'){
                $cookie = cookie()->forever('bw_login_remember', $email);
            }else{
                $cookie = cookie()->forget('bw_login_remember');
            }

            // set/remove cookie
            $response->withCookie($cookie);

        }else{
            $response = redirect(config('bw.admin.url') . '/login')
                ->with('mensagem', 'Usuário e/ou senha inválidos!')
                ->withInput($request->except('password'));
        }

        //
        return $response;
    }

}
