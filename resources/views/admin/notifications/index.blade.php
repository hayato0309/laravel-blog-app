@extends('layouts.admin')

@section('admin.content')

    <h1 class="mb-4">Notifications</h1>

    {{-- Notificationが0件の時（既読含む） --}}
    @if ($unread_notifications == NULL && $read_notifications == NULL)

        <div class="text-muted">No notifications yet.</div>

    @else

        {{-- 未読Notification用 --}}
        <div class="mb-3">
            <h5 class="text-muted"><i class="far fa-square mr-2"></i>Unread</h5>
            @forelse ($unread_notifications as $unread_notification)
                <div class="container card px-5 py-3 mb-2 border-0 shadow-sm">
                    <div class="row">
                        <div class="col-md-9">
                            {{-- 新しいUserが登録した時の通知 --}}
                            <span>
                                <i class="far fa-user mr-2"></i>
                                <a href="{{ route('user.show', $unread_notification['user_id']) }}">{{ $unread_notification['user_name'] }}</a>
                                <span> was just registered.</span>
                                <span class="text-muted"> - {{ $unread_notification['email'] }}</span>
                            </span>
                        </div>
                        <div class="col-md-3 text-muted text-right">
                            {{ $unread_notification['created_at'] }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-muted">No unread notification.</div>
            @endforelse
        </div>

        {{-- 既読Notification用 --}}
        <div class="mb-3">
            <h5 class="text-muted"><i class="far fa-square mr-2"></i>Read</h5>
            @forelse ($read_notifications as $read_notification)
                <div class="container card px-5 py-3 mb-2 border-0 bg-light">
                    <div class="row">
                        <div class="col-md-9">
                            {{-- 新しいUserが登録した時の通知 --}}
                            <span>
                                <i class="far fa-user mr-2"></i>
                                <a href="{{ route('user.show', $read_notification['user_id']) }}">{{ $read_notification['user_name'] }}</a>
                                <span> was registered.</span>
                                <span class="text-muted"> - {{ $read_notification['email'] }}</span>
                            </span>
                        </div>
                        <div class="col-md-3 text-muted text-right">
                            {{ $read_notification['created_at'] }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-muted">No read notification.</div>
            @endforelse
        </div>
    @endif


@endsection