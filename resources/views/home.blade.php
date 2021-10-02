@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        {{-- Left sidebar --}}
        <div class="col-md-3 p-3">
            <div class="p-3 mb-3 bg-white rounded">
                <div class="btn-group btn-group-toggle w-100">
                    <a class="btn btn-outline-dark active">Articles</a>
                    <a href="{{ route('ensemble.home') }}" class="btn btn-outline-dark">Ensembles</a>
                </div>
            </div>

            <div class="p-3 bg-white rounded">
                <a href="{{ route('home') }}" class="text-body">
                    <div class="card p-3 mb-2 border-0 shadow-sm navy-background">
                        <div>Show all categories' posts</div>
                    </div>
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('post.categoryPost', $category->id) }}" class="text-body">
                        <div class="card p-3 mb-2 border-0 shadow-sm">
                            <h5>{{ $category->name }}</h5>
                            <div clas="d-flex">
                                @foreach($category->count_for_each_post_type as $count_post)                            
                                    <span class="mr-1">
                                        <span>{{ $count_post['name'] }}: </span>
                                        <span>{{ $count_post['num_of_posts'] }}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Body (Center) --}}
        <div class="col-md-6 p-3">
            @if(session('post-created-message'))
                <div class="alert alert-success">{{ session('post-created-message') }}</div>
            @elseif(session('inquiry-submitted-message'))
                <div class="alert alert-success">{{ session('inquiry-submitted-message') }}</div>
            @endif
            
            <div>
                @forelse ($posts as $post)
                    <div class="card mb-3 border-0 shadow-sm w-100">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <img src="{{ asset('storage/'.$post->post_image) }}" alt="post-image" class="rounded-left w-100 h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="col-md-9 card-title"><a href="{{ route('post.show', $post->id) }}" class="text-body">{{ $post->title }}</a></h5> 
                                        <div class="col-md-3 text-right">
                                            @if($post->postType->slug === "article")
                                                <div><span class="badge badge-pill badge-white border border-dark px-2 py-1"><i class="far fa-newspaper"></i> {{ $post->postType->name }}</span></div>
                                            @elseif($post->postType->slug === "question")
                                                <div><span class="badge badge-pill badge-dark px-2 py-1"><i class="far fa-question-circle"></i> {{ $post->postType->name }}</span></div>
                                            @else
                                                <div><span class="badge badge-pill badge-secondary px-2 py-1"><i class="fas fa-square"></i> {{ $post->postType->name }}</span></div>
                                            @endif
                                        </div>
                                    </div>
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
                @empty
                    <div class="text-muted">No posts yet.</div>
                @endforelse
                {{ $posts->appends(Request::only('post_search'))->links() }}
            </div>
        </div>

        {{-- Right sidebar --}}
        <div class="col-md-3 p-3">
            <div class="rounded bg-white p-3 mb-3">
                <form action="{{ route('home') }}" method="GET" class="mb-2">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="post_search" class="form-control" value="{{ isset($post_search) ? $post_search : '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm btn-block">Clear search keyword</a>
            </div>
            <div class="rounded bg-white p-3">
                <h5 class="mb-3">Recent news</h5>
                @foreach ($news_list as $news)
                    <a href="{{ $news['url'] }}" class="text-body" target="_blank">
                        <div class="card p-3 mb-2 border-0 bg-white shadow-sm">
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
