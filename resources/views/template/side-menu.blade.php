
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
            @elseif (($user->role) ==4 )
                Department Representative
            @endif</p>
        </div>
             
        <!-- search form -->
        <form action="{{ url('search-tickets') }}" method="get" class="sidebar-form">
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
            <li class="{{ Request::is( 'unassigned-tickets') || Request::is( 'in-process-tickets') || Request::is( 'pending-tickets') || Request::is( 'closed-tickets') ? 'active' : '' || Request::is( 'cancelled-tickets') ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Tickets</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is( 'unassigned-tickets') ? 'active' : '' }}"><a href="{{ url('unassigned-tickets') }}"><i class="fa fa-circle-o"></i> Unassigned</a></li>
                    <li class="{{ Request::is( 'in-process-tickets') ? 'active' : '' }}"><a href="{{ url('in-process-tickets') }}"><i class="fa fa-circle-o"></i> In Process</a></li>
                    <li class="{{ Request::is( 'pending-tickets') ? 'active' : '' }}"><a href="{{ url('pending-tickets') }}"><i class="fa fa-circle-o"></i> Pending</a></li>
                    <li class="{{ Request::is( 'closed-tickets') ? 'active' : '' }}"><a href="{{ url('closed-tickets') }}"><i class="fa fa-circle-o"></i> Closed</a></li>
                    <li class="{{ Request::is( 'cancelled-tickets') ? 'active' : '' }}"><a href="{{ url('cancelled-tickets') }}"><i class="fa fa-circle-o"></i> Cancelled</a></li>
                </ul>
            </li>
            @if($user->role<1)
                <li class="{{ Request::is( 'users') ? 'active' : '' }}">
                    <a href="/users">
                        <i class="fa fa-user"></i> <span>Users</span>
                    </a>
                </li>
            @endif
            @if($user->role<2)
                <li class="{{ Request::is( 'departments') ? 'active' : '' }}">
                    <a href="/departments">
                        <i class="fa fa-building-o"></i> <span>Agency</span>
                    </a>
                </li>
            @endif
            @if($user->role==0)
            <li class="{{ Request::is( 'announcement') ? 'active' : '' }}">
                <a href="/announcements">
                    <i class="fa fa-quote-left"></i> <span>Announcements</span>
                </a>
            </li>
            @endif
            <li class="{{ Request::is( 'reports') ? 'active' : '' }}">
                <a href="/reports">
                    <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>