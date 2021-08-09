@extends('layouts.admin')

@section('admin.content')

    {{-- @if(session('post-deleted-message'))
        <div class="alert alert-danger">{{ session('post-deleted-message') }}</div>
    @endif --}}

    <h1 class="mb-4">Notifications</h1>

    @forelse ($notifications as $notification)
        <div class="container card px-5 py-3 mb-2 border-0 shadow-sm">
            <div class="row">
                <div class="col-md-1">
                    <i class="far fa-user"></i>
                </div>
                <div class="col-md-8">
                    <span><a href="#">{{ $notification->data->name }}</a> ({{ $notification->data->email }}) was just registered.</span>
                </div>
                <div class="col-md-3 text-muted text-right">
                    {{ $notification->created_at }}    
                </div>
            </div>
        </div>
    @empty
        <div>No notifications for now.</div>
    @endforelse

@endsection