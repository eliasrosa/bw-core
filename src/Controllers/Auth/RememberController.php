<?php

namespace BW\Controllers\Auth;

use Mail;
use Eliasrosa\SafeValue;
use BW\Models\User;
use Illuminate\Http\Request;
use BW\Controllers\BaseController;

class RememberController extends BaseController
{

    public function getRemember()
    {
        return $this->view('login.remember');
    }

    public function postRemember(Request $request)
    {
        //
        $email = $request->input('email');

        //
        $user = User::where('email', $email)
            ->where('status', 1)
            ->first();

        if($user){

            $token = new SafeValue();
            $token->setCustomKey(env('APP_KEY', null));
            $token->setTimeExpire(config('auth.email.remember.expire'));

            $dados = [
                'name' => $user->name,
                'email' => $user->email,
                'url' => route('bw.login.reset', ['token' => $token->encode($user->id)])
            ];

            //
            Mail::send(config('bw.views.login.email'), $dados, function ($mail) use($email)  {
                $mail->to($email);
                $mail->subject(config('auth.email.remember.subject'));
            });

            //
            return redirect()->route('bw.login.remember')
                ->with('ok', true);
        }

        //
        return redirect()->route('bw.login.remember')
            ->with('mensagem', 'Usuário não encontrado!');
    }
}
