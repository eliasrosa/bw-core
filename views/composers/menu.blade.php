<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <!--
             <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            -->

            @foreach($menus as $m1)
                <li>
                    <a href={{ $m1['href'] }}><i class="{{ $m1['icon'] or 'fa fa-angle-double-right' }}"></i> {{ $m1['label'] }}
                        @if(isset($m1['itens']))
                            <span class="fa arrow"></span>
                        @endif
                    </a>

                    @if(isset($m1['itens']))
                        <ul class="nav nav-second-level">
                        @foreach($m1['itens'] as $m2)
                             <li>
                                <a href={{ $m2['href'] }}><i class="{{ $m2['icon'] or 'fa fa-angle-double-right' }}"></i> {{ $m2['label'] }}
                                    @if(isset($m2['itens']))
                                        <span class="fa arrow"></span>
                                    @endif
                                </a>

                                @if(isset($m2['itens']))
                                    <ul class="nav nav-third-level">
                                    @foreach($m2['itens'] as $m3)
                                         <li>
                                            <a href={{ $m3['href'] }}><i class="fa fa-angle-double-right"></i> {{ $m3['label'] }}</a>
                                        </li>
                                    @endforeach
                                    </ul>
                                @endif


                            </li>
                        @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach

        </ul>
    </div>
</div>
