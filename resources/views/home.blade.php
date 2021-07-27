@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        {{-- Left sidebar --}}
        <div class="col-md-3 p-3 bg-white rounded">
            @foreach($categories as $category)
                <a href="{{ route('post.categoryPost', $category->id) }}" class="text-body">
                    <div class="card p-3 mb-2 border-0 bg-white shadow-sm">
                        <h5>{{ $category->name }}</h5>
                        <div>{{ $category->posts->count() }} posts</div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Body (Center) --}}
        <div class="col-md-6">
            @if(session('post-created-message'))
                <div class="alert alert-success">{{ session('post-created-message') }}</div>
            @endif
            <div class="px-2">
                @foreach ($posts as $post)
                    <div class="card mb-2 shadow-sm border-0">
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
            </div>
            {{ $posts->appends(Request::only('post_search'))->links() }}
        </div>

        {{-- Right sidebar --}}
        <div class="col-md-3 p-0">
            <div class="rounded bg-white p-3 mb-3">
                <form action="{{ route('home') }}" method="GET" class="form-inline mb-3">
                    {{-- @csrf --}}
                    <div class="form-group mr-2">
                        <input type="search" class="form-control" name="post_search" value="{{ isset($post_search) ? $post_search : '' }}">
                    </div>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="rounded bg-white p-3 mb-3">
                <h4>News API</h4>
            </div>
        </div>
    </div>
</div>
@endsection
