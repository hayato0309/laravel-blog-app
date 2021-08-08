@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- @if(session('post-deleted-message'))
                <div class="alert alert-danger">{{ session('post-deleted-message') }}</div>
            @endif --}}

            <h1 class="mb-4">Activity logs</h1>

            @forelse ($activity_logs as $activity_log)
                <div class="container card px-5 py-3 mb-2 border-0 shadow-sm">
                    <div class="row">
                        <div class="col-md-9">
                            <span><a href="{{ route('post.show', $activity_log->notifiable_id) }}">{{ $activity_log->data->title }}</a> was posted.</span>
                        </div>
                        <div class="col-md-3 text-muted text-right">
                            {{ $activity_log->created_at }}
                        </div>
                    </div>
                </div>
            @empty
                <div>No activity logs yet.</div>
            @endforelse

        </div>
    </div>
</div>

@endsection