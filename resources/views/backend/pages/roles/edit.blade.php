@extends('backend.layouts.master')

@section('title')
     Role Edit
@endsection

@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection

@section('admin-content')
            <!-- main content area start -->
            <div class="main-content">


                @include('backend.layouts.partials.header')
    
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Roles Create- {{ $role->name}}</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{ route('roles.index')}}">All Roles</a></li>
                                    <li><span>Edit Role</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            @include('backend.layouts.partials.logout')
                        </div>
                    </div>
                </div>
                <!-- page title area end -->
                <div class="main-content-inner">
                    <div class="row">
                        <!-- data table start -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Edit Role</h4>
                                    @include('backend.layouts.partials.validation')

                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif



                                  <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                      @method('PUT')
                                      @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" placeholder="enter a role name">
                                    </div>
                                    <p>Permission</p>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkAll" value="" {{ App\Models\User::roleHasPermissions($role, $all_permissions)? 'checked':''}}>
                                            <label for="checkAll" class="form-check-label">All</label>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group">

                                    @php $i = 1; @endphp
                                    @foreach ($permission_groups as $group )
                                        @php
                                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                            $j = 1;
                                        @endphp
                                        <div class="row AllCheckBoxStatus">
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input groupCheckBox" id="{{ $i }}Management" value="{{$group->name}}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions)? 'checked':''}}>
                                                    <label class="form-check-label" for="{{ $i }}Management">{{ $group->name }}</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 role-{{ $i }}-management-checkbox">

                                                @foreach ($permissions as $permission)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" {{ $role->hasPermissionTo($permission->name)? 'checked': ''}} id="checkPermission{{$permission->id}}" value="{{$permission->name}}" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})">
                                                        <label for="checkPermission{{$permission->id}}" class="form-check-label">{{$permission->name}}</label>
                                                    </div>
                                                    @php $j++; @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                        @php $i++; @endphp
                                    @endforeach

                                    {{-- <div class="form-group">
                                        <label for="name">Permission</label>

                                    </div> --}}
                                </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update Role</button>
                                  </form>
                                </div>
                            </div>
                        </div>
                        <!-- data table end -->

                    </div>
                </div>
            </div>
            <!-- main content area end -->
@endsection

@section('scripts')

@include('backend.pages.roles.partials.script')

@endsection