@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('comment-posted-message'))
                <div class="alert alert-success">{{ session('comment-posted-message') }}</div>
            @elseif(session('comment-updated-message'))
                <div class="alert alert-success">{{ session('comment-updated-message') }}</div>
            @elseif(session('comment-deleted-message'))
                <div class="alert alert-danger">{{ session('comment-deleted-message') }}</div>
            @endif

            {{-- Breadcrumb list --}}
            <div class="mb-4">
                <a href="{{ route('home') }}" class="text-body"><i class="fas fa-home"></i></a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{ $post->title }}</a>
            </div>
            
            <div class="mb-3">
                <div class="row">
                    <h1 class="col-md-10 mb-4">{{ $post->title }}</h1>

                    <div class="col-md-2 text-right">
                        @if($post->postType->slug === "article")
                            <h5><span class="badge badge-pill badge-light border border-dark px-3 py-2"><i class="far fa-newspaper"></i> {{ $post->postType->name }}</span></h5>
                        @elseif($post->postType->slug === "question")
                            <h5><span class="badge badge-pill badge-dark px-3 py-2"><i class="far fa-question-circle"></i> {{ $post->postType->name }}</span></h5>
                        @endif
                    </div>
                </div>
                <div class="mb-4">{{ $post->content }}</div>
                <div class="text-right mb-4">
                    <div class="d-inline mr-3">
                        @if($isLiked)
                            <a href="{{ route('post.like', $post->id) }}" class="text-decoration-none">
                                <i class="fas fa-heart d-inline text-danger"></i>
                            </a>
                            <span class="text-danger">{{ $likesCount }}</span>
                        @else
                            <a href="{{ route('post.like', $post->id) }}" class="text-decoration-none">
                                <i class="far fa-heart d-inline text-muted"></i>
                            </a>
                            <span class="text-muted">{{ $likesCount }}</span>
                        @endif
                    </div>
                    <div class="d-inline text-muted">{{ $post->created_at->diffForHumans() }} by <a href="{{ route('user.show', $post->user->id) }}" class="text-muted">{{ $post->user->name }}</a></div>
                </div>
                @if($post->post_image != "images/post_image.png")
                    <img class="rounded mb-4" src="{{ asset('storage/'.$post->post_image) }}" alt="avatar" style="width:30%">
                @else
                    <div class="text-muted mb-4">* This post has no image.</div>
                @endif

                <div>
                    @foreach ($categories as $category)
                        <div class="badge badge-pill badge-secondary px-2 py-1">{{ $category->name }}</div>
                    @endforeach
                </div>
            </div>
            
            {{-- Comments display area --}}
            @foreach ($comments as $comment)
                <div>
                    <div class="rounded shadow-sm p-3 bg-white">
                        <div class="d-inline-block h-auto w-100 mb-1">
                            <img class="rounded-circle float-left mr-2" src="{{ asset('storage/'.$comment->user->avatar) }}" alt="comment-user-image" style="width:45px">
                            <div class="float-left">
                                <div><a href="{{ route('user.show', $comment->user->id) }}" class="text-body">{{ $comment->user->name }}</a></div>
                                <div class="text-muted">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                            
                            {{-- Edit and delete buttons - Parent comment --}}
                            @if($comment->user_id == Auth::user()->id)
                            <div class="text-right">
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#parent-comment-edit-modal-{{ $comment->id }}">
                                    <i class="far fa-edit mr-1 text-body"></i>
                                </button>
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#parent-comment-delete-modal-{{ $comment->id }}">
                                    <i class="far fa-trash-alt text-body"></i>
                                </button>
                            </div>
                            @endif
                            
                        </div>
                        <div class="border-left px-3">{{ $comment->comment }}</div>
                    </div>

                    {{-- Triger to display nested comment textarea --}}
                    <div class="text-right">
                        <a class="btn btn-link p-0 text-muted" data-toggle="collapse" href="#collapse-nested-comments-and-textarea-{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapse-nested-comments-and-textarea-{{ $comment->id }}">
                            <i class="far fa-comment"></i>
                            <span>{{ $comment->replies->count() }}</span>
                        </a>
                    </div>

                    {{-- Collapse area - Nested comments and textares --}}
                    <div class="collapse mb-2" id="collapse-nested-comments-and-textarea-{{ $comment->id }}">
                        
                        {{-- Display nested comment --}}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">

                                @foreach($comment->replies as $reply)
                                    <div class="rounded shadow-sm p-3 mb-2 bg-white">
                                        <div class="d-inline-block h-auto w-100 mb-1">
                                            <img class="rounded-circle float-left mr-2" src="{{ asset('storage/'.$comment->user->avatar) }}" alt="comment-user-image" style="width:45px">
                                            <div class="float-left">
                                                <div><a href="{{ route('user.show', $comment->user->id) }}" class="text-body">{{ $comment->user->name }}</a></div>
                                                <div class="text-muted">{{ $comment->created_at->diffForHumans() }}</div>
                                            </div>
                                            
                                            {{-- Edit and delete buttons - Child comment --}}
                                            @if($reply->user_id == Auth::user()->id)
                                            <div class="text-right">
                                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#child-comment-edit-modal-{{ $reply->id }}">
                                                    <i class="far fa-edit mr-1 text-body"></i>
                                                </button>
                                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#child-comment-delete-modal-{{ $reply->id }}">
                                                    <i class="far fa-trash-alt text-body"></i>
                                                </button>
                                            </div>
                                            @endif
                                            
                                        </div>
                                        <div class="border-left px-3">{{ $reply->comment }}</div>
                                    </div>

                                    {{-- Child comment edit modal --}}
                                    <div class="modal fade" id="child-comment-edit-modal-{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit the comment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <form action="{{ route('comment.update', $reply->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PATCH')

                                                        <textarea type="text" class="form-control mb-2 {{ $errors->has('updated_comment')?'is-invalid':'' }}" name="updated_comment" cols="30" rows="3" placeholder="Please write your comment.">{{ $reply->comment }}</textarea>
                                                        @if($errors->has('updated_comment'))
                                                            <p class="text-danger">{{ $errors->first('updated_comment') }}</p>
                                                        @endif
                                                    </div> 

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Child comment delete modal --}}
                                    <div class="modal fade" id="child-comment-delete-modal-{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this comment?</p>
                                                    <p class="border-left px-3">{{ Str::limit($reply->comment, 200, '...') }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{ route('comment.destroy', $reply->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger-custamized">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <form action="{{ route('comment.replyStore', ['post_id' => $post->id, 'comment_id' => $comment->id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div>
                                        <textarea type="text" class="form-control mb-1 {{ $errors->has('comment')?'is-invalid':'' }}" name="comment" rows="2" placeholder="Please reply to the comment.">{{ old('reply') }}</textarea>
                                    
                                        @if($errors->has('comment'))
                                            <p class="text-danger">{{ $errors->first('comment') }}</p>
                                        @endif

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>

                {{-- Parent comment edit modal --}}
                <div class="modal fade" id="parent-comment-edit-modal-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit the comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('PATCH')

                                    <textarea type="text" class="form-control mb-2 {{ $errors->has('updated_comment')?'is-invalid':'' }}" name="updated_comment" cols="30" rows="3" placeholder="Please write your comment.">{{ $comment->comment }}</textarea>
                                    @if($errors->has('updated_content'))
                                        <p class="text-danger">{{ $errors->first('updated_comment') }}</p>
                                    @endif
                                </div> 

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Parent comment delete modal --}}
                <div class="modal fade" id="parent-comment-delete-modal-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this comment?</p>
                                <p class="border-left px-3">{{ Str::limit($comment->comment, 200, '...') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custamized">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

            {{-- Comments textarea --}}
            <div>
                <div class="text-muted text-right">
                    <i class="far fa-comment-alt"></i>
                    <span>Comment</span>
                </div>
                <form action="{{ route('comment.store', $post->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <textarea type="text" class="form-control mb-2 {{ $errors->has('content')?'is-invalid':'' }}" name="comment" cols="30" rows="3" placeholder="Please write your comment.">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                        <p class="text-danger">{{ $errors->first('comment') }}</p>
                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection