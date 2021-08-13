@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h1 class="mb-4">Notifications</h1>

            @if ($unread_notifications == NULL && $read_notifications == NULL)

                <div>No notifications yet.</div>

            @else
                <div class="mb-3">
                    <h5><i class="far fa-square"></i> Unread</h5>
                    @forelse ($unread_notifications as $unread_notification)
                        <div class="container card px-5 py-3 mb-2 border-0 shadow-sm">
                            <div class="row">
                                <div class="col-md-9">
                                    <span>
                                        <a href="{{ route('user.show', $unread_notification->data['user_id']) }}">{{ $unread_notification->data['user_name'] }}</a>
                                        <span> posted </span>
                                        <a href="{{ route('post.show', $unread_notification->notifiable_id) }}">{{ $unread_notification->data['title'] }}</a>
                                        <span>[{{ $unread_notification->data['post_type']}}]</span>
                                    </span>
                                </div>
                                <div class="col-md-3 text-muted text-right">
                                    {{ $unread_notification->created_at }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">No unread notification.</div>
                    @endforelse
                </div>

                <div class="mb-3">
                    <h5><i class="far fa-square"></i> Read</h5>
                    @forelse ($read_notifications as $read_notification)
                        <div class="container card px-5 py-3 mb-2 border-0">
                            <div class="row">
                                <div class="col-md-9">
                                    <span>
                                        <a href="{{ route('user.show', $read_notification->data['user_id']) }}">{{ $read_notification->data['user_name'] }}</a>
                                        <span> posted </span>
                                        <a href="{{ route('post.show', $read_notification->notifiable_id) }}">{{ $read_notification->data['title'] }}</a>
                                        <span>[{{ $read_notification->data['post_type']}}]</span>
                                    </span>
                                </div>
                                <div class="col-md-3 text-muted text-right">
                                    {{ $read_notification->created_at }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">No read notification.</div>
                    @endforelse
                </div>
            @endif

        </div>
    </div>
</div>

@endsection