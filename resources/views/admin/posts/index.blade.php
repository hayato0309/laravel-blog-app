@extends('layouts.admin')

@section('admin.content')
    @if(session('post-hidden-message'))
        <div class="alert alert-danger">{{ session('post-hidden-message') }}</div>
    {{-- @elseif(session('user-activated-message'))
        <div class="alert alert-success">{{ session('user-activated-message') }}</div> --}}
    @endif

    <h1 class="mb-4">Post list</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Likes</th>
                <th scope="col">Auther</th>
                <th scope="col">Created at</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                    <td class="align-middle"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></td>
                    <td class="align-middle">{{ Str::limit($post->content, 50, '...') }}</td>
                    <td class="align-middle">{{ $post->likes->count() }}</td>
                    <td class="align-middle"><a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a></td>
                    <td class="align-middle">{{ $post->created_at }}</td>
                    <td class="align-middle">
                        @if($post->deleted_at)
                            <div class="text-danger">Hidden</div>
                        @else
                            <div>Visible</div>
                        @endif
                    </td>
                    <td class="align-middle">
                        <!-- Button trigger modal -->
                        @if($post->deleted_at)
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-unhide-{{ $post->id }}">
                                <i class="fas fa-toggle-off text-body"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-hide-{{ $post->id }}">
                                <i class="fas fa-toggle-on text-body"></i>
                            </button>
                        @endif
                            
                        <!-- Modal for hiding the post -->
                        <div class="modal fade" id="modal-hide-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hide confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">Are you sure you want to hide this post?</div>
                                        <div class="mb-1">Title</div>
                                        <div class="mb-2 px-3 border-left">{{ $post->title }}</div>
                                        <div class="mb-1">Content</div>
                                        <div class="px-3 border-left">{{ Str::limit($post->content, 200, '...') }}</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.hidePost', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custamized">Hide</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for unhiding the post -->
                        <div class="modal fade" id="modal-unhide-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hide confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">Are you sure you want to unhide this post?</div>
                                        <div class="mb-1">Title</div>
                                        <div class="mb-2 px-3 border-left">{{ $post->title }}</div>
                                        <div class="mb-1">Content</div>
                                        <div class="px-3 border-left">{{ Str::limit($post->content, 200, '...') }}</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.unhidePost', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary">Unhide</button>
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
@endsection