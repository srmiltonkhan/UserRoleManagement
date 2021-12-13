@extends('errors.error_layout')

@section('error-title')
403-Access Denied
@endsection
   
@section('error-content')
<div class="error-content">
    <h2>403</h2>
    <p>Access to this resource on the server is denied</p>
    <p>
        {{ $exception->getMessage() }}
    </p>
    <a href="{{ route('admin.dashboard')}}">Back to Dashboard</a>
    <a href="{{ route('admin.login')}}">Login Again</a>
</div>
@endsection