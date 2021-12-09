        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('backend/assets/images/icon/logo.png')}}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="false"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse {{ Route::is('admin.dashboard') ? 'in' : ''}}">
                                    <li class="{{ Route::is('admin.dashboard') ? 'active' : ''}}"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Roles & Permission MGT
                                    </span></a>
                                <ul class="collapse {{ Route::is('roles.create','roles.index') ? 'in' : ''}}">
                                    <li class="{{ Route::is('roles.index') ? 'active' : ''}}"><a href="{{ route('roles.index')}}">All Roles</a></li>
                                    <li class="{{ Route::is('roles.create') ? 'active' : ''}}"><a href="{{ route('roles.create')}}">Create Role</a></li>
                                </ul>
                            </li>
  

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
