    <li class="active">
        <a href="{{ route('bw.home') }}"><span class="icon glyphicon glyphicon-home"></span>Home</a>
    </li>
@foreach($menus as $m1)
    <li>
        <a href={{ $m1['href'] }}><span class="icon {{ $m1['icon'] or 'fa fa-angle-double-right' }}"></span>{{ $m1['label'] }}</a>

        @if(isset($m1['itens']))
            <ul class="nav nav-second-level">
            @foreach($m1['itens'] as $m2)
                 <li>
                    <a href={{ $m2['href'] }}><span class="icon {{ $m2['icon'] or 'fa fa-angle-double-right' }}"></span>{{ $m2['label'] }}</a>

                    @if(isset($m2['itens']))
                        <ul class="nav nav-third-level">
                        @foreach($m2['itens'] as $m3)
                             <li>
                                <a href={{ $m3['href'] }}><span class="icon fa fa-angle-double-right"></span>{{ $m3['label'] }}</a></li>
                        @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach
            </ul>
        @endif

    </li>
@endforeach
    <li>
        <a href=#><span class="icon fa fa-gear"></span>Configurações</a>
        <ul class="nav nav-second-level">
            <li>
                <a href=#><span class="icon fa fa-angle-double-right"></span>Gerenciar usuários</a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="{{ route('bw.users.index') }}"><span class="icon fa fa-angle-double-right"></span>Usuários</a>
                    </li>
                    <li>
                        <a href="{{ route('bw.users.groups.index') }}"><span class="icon fa fa-angle-double-right"></span>Grupos</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
