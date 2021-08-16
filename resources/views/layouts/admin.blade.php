@extends('layouts.app')

@section('content')

<div class="container-fluid px-3">
    <div class="row">
        <div class="col-sm-2">
            <div class="p-4 rounded bg-white">
                <ul class="list-unstyled">
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.home') }}" class="text-decoration-none text-body">Home</a>
                    </li>
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.notifications') }}" class="text-decoration-none text-body">Notifications</a>
                            <span class="small">
                                <span class="badge badge-pill badge-danger">
                                    @if($num_of_unread_notifications_for_admin > 0)
                                        {{ $num_of_unread_notifications_for_admin }}
                                    @endif
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.inquiries') }}" class="text-decoration-none text-body">Inquiries</a>
                    </li>
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.users') }}" class="text-decoration-none text-body">Users</a>
                    </li>
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.posts') }}" class="text-decoration-none text-body">Posts</a>
                    </li>
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.postTypes') }}" class="text-decoration-none text-body">Post types</a>
                    </li>
                    <li class="h5 mb-3">
                        <a href="{{ route('admin.categories') }}" class="text-decoration-none text-body">Categories</a>
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