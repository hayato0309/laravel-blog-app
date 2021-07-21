@extends('layouts.app')

@section('content')

<div class="container-fluid px-3">
    <div class="row">
        <div class="col-sm-2">
            <div class="p-4 rounded bg-white">
                <ul class="list-unstyled">
                    <li class="h5 mb-3"><a href="{{ route('admin.home') }}" class="text-muted"><i class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="h5 mb-3"><a href="{{ route('admin.showUsers') }}" class="text-muted"><i class="fas fa-users mr-2"></i>Users</a></li>
                    <li class="h5 mb-3"><a href="{{ route('admin.showPosts') }}" class="text-muted"><i class="fas fa-newspaper mr-2"></i>Posts</a></li>
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