@extends('layouts.app')

@section('content')

<div class="container-fluid px-3">
    <div class="row">
        <div class="col-sm-2">
            <div class="p-4 rounded bg-white">
                <ul class="list-unstyled">
                    <li class="row h5 mb-3">
                        <a href="{{ route('admin.home') }}" class="text-decoration-none text-body">
                            <i class="fas fa-home col-sm-1"></i>
                            <span class="col-sm-11">Home</span>
                        </a>
                    </li>
                    <li class="row h5 mb-3">
                        <a href="{{ route('admin.notifications') }}" class="text-decoration-none text-body">
                            <i class="fas fa-bell col-sm-1"></i>
                            <span class="col-sm-11">Notifications</span>
                        </a>
                    </li>
                    <li class="row h5 mb-3">
                        <a href="{{ route('admin.users') }}" class="text-decoration-none text-body">
                            <i class="fas fa-users col-sm-1"></i>
                            <span class="col-sm-11">Users</span>
                        </a>
                    </li>
                    <li class="row h5 mb-3">
                        <a href="{{ route('admin.posts') }}" class="text-decoration-none text-body">
                            <i class="fas fa-newspaper col-sm-1"></i>
                            <span class="col-sm-11">Posts</span>
                        </a>
                    </li>
                    <li class="row h5 mb-3">
                        <a href="{{ route('admin.postTypes') }}" class="text-decoration-none text-body">
                            <i class="fas fa-folder col-sm-1"></i>
                            <span class="col-sm-11">Post types</span>
                        </a>
                    </li>
                    <li class="row h5 mb-3">
                        <a href="{{ route('admin.categories') }}" class="text-decoration-none text-body">
                            <i class="fas fa-th-large col-sm-1"></i>
                            <span class="col-sm-11">Categories</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 pl-0">
            <div class="p-4 rounded bg-white">
                @yield('admin.content')
            </div>
        </div>
    </div>
</div>

@endsection