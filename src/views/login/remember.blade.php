@extends('BW::login.template')

@section('content')

    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ session('ok') ? 'Verifique seu e-mail' : 'Esqueci minha senha' }}</h3>
        </div>
        <div class="panel-body">

            @if (session('ok'))

                <p>Enviamos um link para a criação de uma nova senha para o seu e-mail</p>
                <p>Agora basta acessá-lo e escolher uma nova senha.</p>

                <h4>Importante</h4>

                <ul>
                    <li>O link enviado expira em {{ config('auth.email.remember.expire') / 60 / 60 }} horas. Após esse prazo, ele não vai funcionar.</li>
                </ul>

            @else
                <form role="form" method="POST" action="{{ route('bw.login.remember') }}">
                    {!! csrf_field() !!}

                    @if (session('mensagem'))
                        <div class="alert alert-{{ session('mensagem_tipo', 'danger') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('mensagem') }}
                        </div>
                    @endif

                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ old('email') }}" autofocus>
                        </div>

                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Verificar">
                    </fieldset>
                </form>
            @endif
        </div>
    </div>
    <div class="link-footer">
        <a class="link" href="{{ route('bw.login.index') }}">Voltar ao login</a>
    </div>
@endsection
