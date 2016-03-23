<ul class="nav navbar-top-links navbar-right">
    <li>
        <a href="#"><i class="fa fa-user fa-fw"></i> {{ $email }}</a>
    </li>
    <li>
        <a href="{{ url(config('bw.admin.url')) }}/configuracoes"><i class="fa fa-gear fa-fw"></i> Configurações</a>
    </li>
    <li>
        <a href="{{ url(config('bw.admin.url')) }}/logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
    </li>

</ul>

