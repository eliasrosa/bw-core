<ul class="nav navbar-top-links navbar-right">
    <li>
        {{ $email }}
    </li>
    <li>
        <a href="{{ url(config('bw.admin.url')) }}/configuracoes"><i class="fa fa-gear fa-fw"></i> Configurações</a>
    </li>
    <li>
        <a href="{{ url(config('bw.admin.url')) }}/logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
    </li>

</ul>

