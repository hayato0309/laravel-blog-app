@extends('layouts.admin')

@section('admin.content')
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
                    <td class="align-middle">Posted</td>
                    <td class="align-middle">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-{{ $post->id }}">
                            <i class="fas fa-toggle-on text-body"></i>
                        </button>
                            
                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <div>Title</div>
                                        <div class="mb-2 px-2 border-left">{{ $post->title }}</div>
                                        <div>Content</div>
                                        <div class="px-2 border-left">{{ Str::limit($post->content, 200, '...') }}</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custamized">Hide</button>
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