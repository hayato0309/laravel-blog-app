@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('post-created-message'))
                <div class="alert alert-success">{{session('post-created-message')}}</div>
            @endif
            @foreach ($posts as $post)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <div class="card-text">{{Str::limit($post->content, 200, '...')}}</div>
                        <div class="float-right">
                            <div class="d-inline mr-3">
                                <i class="far fa-heart text-muted d-inline"></i>
                                <span class="text-muted">123</span>
                            </div>
                            <div class="float-right text-muted">Posted by {{$post->user->name}} {{$post->created_at->diffForHumans()}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
