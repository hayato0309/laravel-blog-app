@extends('layouts.admin')

@section('admin.content')
    @if(session('category-created-message'))
        <div class="alert alert-success">{{ session('category-created-message') }}</div>
    @endif

    <h1 class="mb-4">Category list</h1>

    <form action="{{ route('admin.categoryStore') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" name="name" placeholder="Name">

                @if($errors->has('name'))
                    <p class="text-danger">{{$errors->first('name')}}</p>
                @endif
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Posts</th>
                <th scope="col">Created at</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="#">{{ $category->name }}</a></td>
                    <td>123</td>
                    <td>{{ $category->created_at }}</td>
                    <td><a href="#"><i class="far fa-edit text-body"></i></a></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-{{ $category->id }}">
                            <i class="far fa-trash-alt text-body"></i>
                        </button>
                            
                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">Are you sure you want to delete this post?</div>
                                        <div class="mb-1">Title</div>
                                        <div class="mb-2 px-3 border-left">{{ $category->title }}</div>
                                        <div class="mb-1">Content</div>
                                        <div class="px-3 border-left">{{ Str::limit($category->content, 200, '...') }}</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('post.destroy', $category->id) }}" method="POST">
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
    {{ $categories->links() }}
@endsection