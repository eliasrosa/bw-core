<ul class="nav navbar-top-links navbar-right">
    <li>
        <a href="#"><i class="fa fa-user fa-fw"></i> {{ $email }}</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear fa-fw"></i> Configurações <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('bw.config.usuarios.index') }}"><i class="fa fa-user fa-fw"></i> Gerenciar usuários</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ url(config('bw.admin.url')) }}/logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
    </li>
</ul>

