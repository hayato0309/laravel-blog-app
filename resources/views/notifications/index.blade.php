@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h1 class="mb-4">Notifications</h1>

            @forelse ($notifications_for_auth as $notification)
                <div class="container card px-5 py-3 mb-2 border-0 shadow-sm">
                    <div class="row">
                        <div class="col-md-9">
                            <span>
                                <a href="{{ route('user.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
                                <span> posted </span>
                                <a href="{{ route('post.show', $notification->notifiable_id) }}">{{ $notification->data['title'] }}</a>
                                <span>[{{ $notification->data['post_type']}}]</span>
                            </span>
                            
                        </div>
                        <div class="col-md-3 text-muted text-right">
                            {{ $notification->created_at }}
                        </div>
                    </div>
                </div>
            @empty
                <div>No notification for now.</div>
            @endforelse

        </div>
    </div>
</div>

@endsection