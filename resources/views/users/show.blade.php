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

            <div class="row mb-4">
                <h1 class="col-sm-10">{{ $user->name }}'s profile</h1>
                <div class="col-sm-2 text-right">
                    @if($user->id != Auth::user()->id)
                        @if($isFollowing)
                            <a href="{{ route('user.follow', $user->id) }}" class="btn btn-outline-primary btn-sm active">Following</a>
                        @else
                            <a href="{{ route('user.follow', $user->id) }}" class="btn btn-outline-primary btn-sm">Follow</a>
                        @endif
                    @endif
                </div>
            </div>

            <div class="row rounded bg-white py-3 mb-3">
                <div class="col-sm-4">
                    <img class="rounded mr-4 shadow-sm" src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" style="width: 100%">
                </div>
                
                <div class="col-sm-8 d-flex flex-column justify-content-between">
                    <div>
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
                        <div>
                            <div class="mb-3 text-muted">Hello everyone! I'm new to here. Nice to meet you! Hello everyone! I'm new to here. Nice to meet you!</div>
                            <h6><i class="fas fa-square"></i> Interests</h6>
                            <div class="border-left px-3 mb-3">Interests will be here</div>
                        </div>
                    </div>
                    <div>
                        {{-- Links to trigger modal for following/follower user list --}}
                        <span class="text-muted mr-1"><a href="#" data-toggle="modal" data-target="#followingModal">123</a> Following</span>
                        <span class="text-muted"><a href="#" data-toggle="modal" data-target="#followerModal">123</a> Followers</span>
                    </div>
                </div>
            </div>

            {{-- Modals for following user list --}}
            <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followingModalTitle">Following</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-sm-10 d-flex align-items-center">
                                <img class="rounded-circle float-left mr-3" src="{{ asset('storage/'.$user->avatar) }}" alt="" style="width: 45px">
                                <div class="float-left">Hayato</div>
                            </div>
                            <div class="col-sm-2 text-right d-flex align-items-center">
                                <button class="btn btn-outline-primary btn-sm">Follow</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            {{-- Modals for following user list --}}
            <div class="modal fade" id="followerModal" tabindex="-1" role="dialog" aria-labelledby="followerModalTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followerModalTitle">Followers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-sm-10 d-flex align-items-center">
                                <img class="rounded-circle float-left mr-3" src="{{ asset('storage/'.$user->avatar) }}" alt="" style="width: 45px">
                                <div class="float-left">Hayato</div>
                            </div>
                            <div class="col-sm-2 text-right d-flex align-items-center">
                                <button class="btn btn-outline-primary btn-sm">Follow</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
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