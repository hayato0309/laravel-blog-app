@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Breadcrumb list --}}
            <div class="mb-4">
                <a href="{{ route('home') }}" class="text-body"><i class="fas fa-home"></i></a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{ $user->name }}'s profile</a>
            </div>

            <h1 class="mb-4">{{ $user->name }}'s profile</h1>

            <div class="rounded bg-white py-3 mb-3 row">
                <div class="col-sm-4">
                    <img class="rounded mr-4 shadow-sm" src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" style="width: 100%">
                </div>
                
                <div class="col-sm-8 h-100">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4>{{ $user->name }}</h4>
                        </div>
        
                        @if($user->id == Auth::user()->id)
                            <div class="col-sm-2 text-right">
                                <a href="{{ route('user.edit', Auth::user()->id) }}"><i class="far fa-edit text-muted"></i></a>
                            </div>
                        @endif
                    </div>
                        <div class="mb-3 text-muted">Hello everyone! I'm new to here. Nice to meet you! Hello everyone! I'm new to here. Nice to meet you!</div>
                        <h6><i class="fas fa-square"></i> Interests</h6>
                        <div class="border-left px-3 mb-3">Interests will be here</div>
                    </div>
                </div>

            {{-- Post list of the user in profile page --}}
            <div class="row">
                <h6 class="mb-3">All {{ $user->name }}'s posts</h6>
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
                                <div class="float-right text-muted">Posted by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>

@endsection