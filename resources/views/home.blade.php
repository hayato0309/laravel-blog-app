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
        <div class="col-md-6 px-3">
            @if(session('post-created-message'))
                <div class="alert alert-success">{{ session('post-created-message') }}</div>
            @endif
            <div>
                @foreach ($posts as $post)
                    <div class="card mb-3 border-0 shadow-sm w-100">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <img src="{{ asset('storage/'.$post->post_image) }}" alt="post-image" class="rounded-left w-100 h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('post.show', $post->id) }}" class="text-body">{{ $post->title }}</a></h5> 
                                <p class="card-text">{{ Str::limit($post->content, 100, '...') }}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach ($post->categories as $category)
                                            <div class="badge badge-pill badge-secondary px-2 py-1">{{ $category->name }}</div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="d-inline mr-2">
                                            @if($post->isLiked)
                                                <i class="fas fa-heart d-inline text-danger"></i>
                                                <span class="text-danger">{{ $post->likes->count() }}</span>
                                            @else
                                                <i class="far fa-heart d-inline text-muted"></i>
                                                <span class="text-muted">{{ $post->likes->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="d-inline text-muted"> 
                                            {{ $post->created_at->diffForHumans() }}
                                            by <a href="{{ route('user.show', $post->user->id) }}" class="text-muted">{{ $post->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $posts->appends(Request::only('post_search'))->links() }}
            </div>
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
                @foreach ($news_list as $news)
                    <a href="{{ $news['url'] }}" class="text-body" target="_blank">
                        <div class="card p-3 mb-2 border-0 bg-white shadow-sm">
                            {{-- <div class="mb-2">{{ $news['title'] }}</div> --}}
                            <img src="{{ $news['thumbnail'] }}" alt="news_image" class="rounded shadow-sm mb-2">
                            <div>{{ $news['title'] }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
