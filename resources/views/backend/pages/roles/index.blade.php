@extends('backend.layouts.master')

@section('title')
    Dashboard
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
                                <h4 class="page-title pull-left">Roles</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                    <li><span>All Roles</span></li>
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
                                    {{-- Success MSg --}}
                                    @include('backend.layouts.partials.successmsg')

                                  <div class="row">
                                      <div class="col">
                                        <h4 class="header-title">Role list</h4>
                                      </div>
                                      <div class="col">
                                        @if (Auth::guard('admin')->user()->can('role.create'))
                                        <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm float-right mb-4">ADD Role & Permissions</a>
                                        @endif
                                    </div>
                                  </div>
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr>
                                                    <th width="5%">Sl</th>
                                                    <th width="10%">Name</th>
                                                    <th width="60%">Permissions</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{$loop->index + 1}}</td>
                                                    <td>{{$role->name}}</td>
                                                    <td>
                                                        @foreach ($role->permissions as $perm)
                                                        <span class="badge badge-info mr-1">
                                                            {{ $perm->name }}
                                                        </span>
                                                        @endforeach  
                                                    </td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('role.edit'))
                                                        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-sm btn-info">Edit</a>
                                                        @endif
                                                        
                                                        @if (Auth::guard('admin')->user()->can('role.delete'))
                                                        <a class="btn btn-danger text-white" href="{{ route('roles.destroy', $role->id) }}"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                                Delete
                                                        </a>
                
                                                        <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                        @endif



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