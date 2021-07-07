@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('post-deleted-message'))
                <div class="alert alert-danger">{{ session('post-deleted-message') }}</div>
            @endif

            <h1>My posts</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Created at</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->content, 50, '...') }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td><a href="#" class="text-body"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-{{ $post->id }}">
                                    <i class="fas fa-trash-alt text-body"></i>
                                </button>
                                    
                                <!-- Modal -->
                                <div class="modal fade" id="modal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this post?</p>
                                                <p>Title: {{ $post->title }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection