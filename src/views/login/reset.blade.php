@extends('BW::login.template')

@section('content')

    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Trocando sua senha</h3>
        </div>
        <div class="panel-body">

            @if ($token)

                <form role="form" method="POST" action="{{ route('bw.login.reset') }}">
                    {!! csrf_field() !!}
                    <input name="token" type="hidden" value="{{ $token }}">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <fieldset>

                        <div class="form-group">
                            <input class="form-control" placeholder="Nova senha" name="password" type="password" value="" autofocus>
                        </div>

                        <div class="form-group">
                            <input class="form-control" placeholder="Confirme sua senha" name="password_confirmation" type="password" value="">
                        </div>

                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Atualizar senha">
                    </fieldset>
                </form>

            @else

                <div class="alert alert-danger alert-dismissable">
                    <p>Token inválido!</p>
                </div>
            @endif
        </div>
    </div>

@endsection

