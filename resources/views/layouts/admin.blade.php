@extends('layouts.app')

@section('content')

<div class="container-fluid px-3">
    <div class="row">
        <div class="col-sm-2">
            <div class="p-4 rounded bg-white">
                <ul class="list-unstyled">
                    <li class="h5 mb-3"><a href="{{ route('admin.home') }}" class="text-muted">Home</a></li>
                    <li class="h5 mb-3"><a href="{{ route('admin.showUsers') }}" class="text-muted">Users</a></li>
                    <li class="h5 mb-3"><a href="#" class="text-muted">Posts</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="p-4 rounded bg-white">
                @yield('admin.content')
            </div>
        </div>
    </div>
</div>

@endsection