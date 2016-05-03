<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
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

            <!-- dashboard -->
            <li>
                <a href="{{ route('bw.home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

            <!-- Usuários -->
            <li>
                <a href="#"><i class="fa fa-users"></i> Usuários<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('bw.users.index') }}">Usuários</a>
                    </li>
                    <li>
                        <a href="{{ route('bw.users.groups.index') }}">Grupos</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
