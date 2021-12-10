@extends('backend.layouts.master')

@section('title')
    Users
@endsection


@section('styles')
        <!-- Start datatable css -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
        <!-- style css -->
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
                                <h4 class="page-title pull-left">Users</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                    <li><span>All Users</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            @include('backend.layouts.partials.logout');
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

                                    {{-- Success MSg Area --}}
                                    @include('backend.layouts.partials.successmsg')
                                    {{-- End Success MSg Area --}}

                                  <div class="row">
                                      <div class="col">
                                        <h4 class="header-title">Users list</h4>
                                      </div>
                                      <div class="col">
                                        <a href="{{route('users.create')}}" class="btn btn-primary btn-sm float-right mb-4">Add User</a>
                                      </div>
                                  </div>
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr>
                                                    <th width="5%">Sl</th>
                                                    <th width="20%">Name</th>
                                                    <th width="20%">Email</th>
                                                    <th width="35%">Roles</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$loop->index + 1}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @foreach ($user->roles as $role)
                                                        <span class="badge badge-info mr-1">
                                                            {{ $role->name }}
                                                        </span>
                                                        @endforeach  
                                                    </td>
                                                    <td>
                                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-info">Edit</a>
                                                        

                                                        <a class="btn btn-danger text-white" href="{{ route('users.destroy', $user->id) }}"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                                Delete
                                                            </a>
                    
                                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                                @method('DELETE')
                                                                @csrf
                                                            </form>

                                                    </td>
                                                </tr>
                                                @endforeach
                                             
                                            </tbody>
                                        </table>
                                    </div>
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
        <!-- Start datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


        <script>
                /*================================
    datatable active
    ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: false
        });
    }

        </script>
@endsection