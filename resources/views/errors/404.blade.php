@extends('errors.error_layout')

@section('error-title')
404-Page not found
@endsection

@section('error-content')
<div class="error-content">
    <h2>404</h2>
    <p>Sorry! Page not found</p>

    <a href="{{ route('admin.dashboard')}}">Back to Dashboard</a>
    <a href="{{ route('admin.login')}}">Login Again</a>
</div>
@endsection