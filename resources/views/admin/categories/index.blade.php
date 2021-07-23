@extends('layouts.admin')

@section('admin.content')
    @if(session('category-created-message'))
        <div class="alert alert-success">{{ session('category-created-message') }}</div>
    @elseif(session('category-updated-message'))
        <div class="alert alert-success">{{ session('category-updated-message') }}</div>
    @elseif(session('category-deleted-message'))
        <div class="alert alert-danger">{{ session('category-deleted-message') }}</div>
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
                    <td>{{ $category->name }}</td>
                    <td>123</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <!-- Button trigger modal for updating category -->
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-update-{{ $category->id }}">
                            <i class="far fa-edit text-body"></i>
                        </button>

                        <!-- Modal for updating category -->
                        <div class="modal fade" id="modal-update-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.categoryUpdate', $category->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PATCH')
    
                                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                        </div> 
            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <!-- Button trigger modal for deleting category -->
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-delete-{{ $category->id }}">
                            <i class="far fa-trash-alt text-body"></i>
                        </button>

                        <!-- Modal for deleting category -->
                        <div class="modal fade" id="modal-delete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">Are you sure you want to delete this category?</div>
                                        <div class="mb-2 px-3 border-left">{{ $category->name }}</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.categoryDestroy', $category->id) }}" method="POST">
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