@extends('backend.layouts.master')

@section('title')
    Create Role
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
                                <h4 class="page-title pull-left">Roles Create</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                    <li><span>All Roles</span></li>
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
                                    <h4 class="header-title">Role Create</h4>
                                    @include('backend.layouts.partials.validation')

                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif



                                  <form action="{{ route('roles.store') }}" method="POST">
                                      @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="enter a role name">
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkAll" value="">
                                            <label for="checkAll" class="form-check-label">All</label>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="form-group">
                                        <label for="name">Permission</label>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{$permission->id}}" value="{{$permission->name}}">
                                                <label for="checkPermission{{$permission->id}}" class="form-check-label">{{$permission->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Save Role</button>
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


        <script>
 
            $('#checkAll').click(function(){
                if($(this).is(':checked')){
                    $('input[type=checkbox]').prop('checked', true)
                }else{
                    $('input[type=checkbox]').prop('checked', false)
                }
            })

        </script>
@endsection