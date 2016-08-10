@extends('BW::login.template')

@section('content')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">

            <form role="form" method="POST" action="{{ route('bw.login.index') }}">
                {!! csrf_field() !!}

                @if (session('mensagem'))
                    <div class="alert alert-{{ session('mensagem_tipo', 'danger') }} alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('mensagem') }}
                    </div>
                @endif

                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ old('email', Cookie::get('bw_login_remember')) }}" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="1"{{ Cookie::has('bw_login_remember') ? ' checked' : '' }}>Lembrar e-mail
                        </label>
                    </div>

                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Entrar">
                </fieldset>
            </form>
        </div>
    </div>
    <div class="link-footer">
        <a class="link" href="{{ route('bw.login.remember') }}">Esqueci minha senha</a>
    </div>
@endsection

@section('script')
    @parent

    <script type="text/javascript">
        $(function(){
            if($('form input[name="email"]').val()){
               $('form input[name="password"]').focus();
            }
        });
    </script>
@endsection
