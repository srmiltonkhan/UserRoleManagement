        @php
        $usr = Auth::guard('admin')->user();
        @endphp
        
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

                            @if ($usr->can('dashboard.view'))
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="false"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse {{ Route::is('admin.dashboard') ? 'in' : ''}}">
                                    <li class="{{ Route::is('admin.dashboard') ? 'active' : ''}}"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                </ul>
                            </li>
                            @endif

                            
                            @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li>
                       
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Roles & Permission MGT
                                    </span></a>
                                <ul class="collapse {{ Route::is('roles.create','roles.index') ? 'in' : ''}}">
                                    @if ($usr->can('role.view'))
                                    <li class="{{ Route::is('roles.index') ? 'active' : ''}}"><a href="{{ route('roles.index')}}">All Roles</a></li>
                                    @endif

                                    @if ($usr->can('role.create'))
                                    <li class="{{ Route::is('roles.create') ? 'active' : ''}}"><a href="{{ route('roles.create')}}">Create Role</a></li>
                                    @endif
                                    
                                </ul>
                            </li>
                            @endif


                            {{-- <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>User
                                    </span></a>
                                <ul class="collapse {{ Route::is('users.create','users.index') ? 'in' : ''}}">
                                    <li class="{{ Route::is('users.index') ? 'active' : ''}}"><a href="{{ route('users.index')}}">All Users</a></li>
                                    <li class="{{ Route::is('users.create') ? 'active' : ''}}"><a href="{{ route('users.create')}}">Create Users</a></li>
                                </ul>
                            </li> --}}


                            @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Admin
                                    </span></a>
                                <ul class="collapse {{ Route::is('admins.create','admins.index') ? 'in' : ''}}">

                                    @if ($usr->can('admin.view'))
                                    <li class="{{ Route::is('admins.index') ? 'active' : ''}}"><a href="{{ route('admins.index')}}">All Admin</a></li>
                                    @endif
                                   
                                    @if ($usr->can('admin.create'))
                                    <li class="{{ Route::is('admins.create') ? 'active' : ''}}"><a href="{{ route('admins.create')}}">Create Admin</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
