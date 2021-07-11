@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('post-created-message'))
                <div class="alert alert-success">{{ session('post-created-message') }}</div>
            @endif
            @foreach ($posts as $post)
                <div class="card mb-2">
                    <div class="card-body">
                        <a href="{{ route('post.show', $post->id) }}" class="text-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </a>
                        <div class="card-text">{{ Str::limit($post->content, 200, '...') }}</div>
                        <div class="float-right">
                            <div class="d-inline mr-3">
                                @if($post->isLiked)
                                    <i class="fas fa-heart d-inline text-danger"></i>
                                    <span class="text-danger">{{ $post->likesCount }}</span>
                                @else
                                    <i class="far fa-heart d-inline text-muted"></i>
                                    <span class="text-muted">{{ $post->likesCount }}</span>
                                @endif
                            </div>
                            <div class="float-right text-muted">Posted by 
                                <a href="{{ route('user.show', $post->user->id) }}" class="text-muted">{{ $post->user->name }}</a>
                                 {{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
