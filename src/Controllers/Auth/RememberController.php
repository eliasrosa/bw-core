<?php

namespace BW\Controllers\Auth;

use Mail;
use Auth;
use Config;
use BW\Models\Usuario;
use Eliasrosa\SafeValue;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RememberController extends Controller
{

    public function getRemember()
    {
        return view(Config('auth.views.remember'));
    }

    public function postRemember(Request $request)
    {
        //
        $email = $request->input('email');

        //
        $usuario = Usuario::where('email', $email)
            ->where('status', 1)
            ->first();

        if($usuario){

            $token = new SafeValue();
            $token->setCustomKey(env('APP_KEY', null));
            $token->setTimeExpire(Config('auth.email.remember.expire'));

            $dados = [
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'url' => url('/' . Config('bw.admin.url') . '/password/reset/' . $token->encode(1)),
            ];

            //
            Mail::send(Config('auth.views.email'), $dados, function ($mail) use($email)  {
                $mail->to($email);
                $mail->subject(Config('auth.email.remember.subject'));
            });

            //
            return redirect(config('bw.admin.url') . '/remember')
                ->with('ok', true);
        }

        //
        return redirect(config('bw.admin.url') . '/remember')
            ->with('mensagem', 'Usuário não encontrado!');
    }
}
