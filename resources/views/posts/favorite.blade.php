@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- @if(session('post-updated-message'))
                <div class="alert alert-success">{{ session('post-updated-message') }}</div>
            @endif --}}

            {{-- Breadcrumb list --}}
            {{-- <div class="mb-4">
                <a href="{{ route('post.posts') }}" class="text-body">My posts</a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{$post->title}}</a>
            </div> --}}

            <h1 class="mb-4">Favorite posts</h1>
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Comments</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liked_posts as $post)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></td>
                                <td>
                                    @foreach ($post->categories as $category)
                                        <div class="badge badge-pill badge-secondary px-2 py-1">{{ $category->name }}</div>
                                    @endforeach
                                </td>
                                <td>{{ $post->likes->count() }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-{{ $post->id }}">
                                        <i class="fas fa-heart-broken text-body"></i>
                                    </button>
                                        
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Undo like confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-2">Are you sure you want to undo like this post?</div>
                                                    <div class="mb-1">Title</div>
                                                    <div class="mb-2 px-3 border-left">{{ $post->title }}</div>
                                                    <div class="mb-1">Content</div>
                                                    <div class="px-3 border-left">{{ Str::limit($post->content, 200, '...') }}</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger-custamized">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            {{ $liked_posts->links() }}
        </div>
    </div>
</div>

@endsection