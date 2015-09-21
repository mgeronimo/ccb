
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <p><span class="user-name">{{ $user->first_name." ".$user->last_name }}</span><br/>
            @if(($user->role) == 0)
                Administrator
            @elseif (($user->role) ==1 )
                Supervisor
            @elseif (($user->role) ==2 )
                Agent
            @endif</p>
        </div>
             
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is( '/') ? 'active' : '' }}">
                <a href="/">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if($user->role<3)
                <li class="{{ Request::is( 'tickets') ? 'active' : '' }}">
                    <a href="/tickets">
                        <i class="fa fa-dashboard"></i> <span>Tickets</span>
                    </a>
                </li>
            @endif
            @if($user->role<=1)
                <li class="{{ Request::is( 'groups') ? 'active' : '' }}">
                    <a href="/groups">
                        <i class="fa fa-group"></i> <span>Groups</span>
                    </a>
                </li>
                <li class="{{ Request::is( 'users') ? 'active' : '' }}">
                    <a href="/users">
                        <i class="fa fa-user"></i> <span>Users</span>
                    </a>
                </li>
            @endif
            <li class="{{ Request::is( 'departments') ? 'active' : '' }}">
                <a href="/departments">
                    <i class="fa fa-building-o"></i> <span>Departments</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>