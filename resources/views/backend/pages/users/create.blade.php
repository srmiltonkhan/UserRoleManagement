@extends('backend.layouts.master')

@section('title')
    Create User
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
                                <h4 class="page-title pull-left">Users Create</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{ route('users.index')}}">All Users </a></li>
                                    <li><span>Create Users</span></li>
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
                                    <h4 class="header-title">User Create</h4>

                                    {{-- Validation Message Area --}}
                                    @include('backend.layouts.partials.validation')





                                    <form action="{{ route('users.store') }}" method="POST">
                                   
                                        @csrf
                                 
                                    <div class="form-row">
                                        <div class="form-group col-md-6 com-sm-12">
                                            <label for="name">User Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Type User Name">
                                        </div>
                                        <div class="form-group col-md-6 com-sm-12">
                                            <label for="email">User Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Type Email Address">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 com-sm-12">
                                            <label for="Password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Type Password">
                                        </div>
                                        <div class="form-group col-md-6 com-sm-12">
                                            <label for="password_confirmation">Cofirm Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Type confirm Password">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 com-sm-12">
                                            <label for="Password">Assign Roles</label>
                                            
                                            <select name="roles[]" id="roles" class="form-control select2" multiple>
                                            <option value="">Selet Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                                @endforeach
                                           </Select>
                                        </div>
                                    
                                    </div>
              
                                    <button type="submit" class="btn btn-primary btn-sm">Save user</button>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

@endsection