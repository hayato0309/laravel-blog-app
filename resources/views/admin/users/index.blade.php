@extends('layouts.admin')

@section('admin.content')
    <h1 class="mb-4">User list</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Email address</th>
                <th scope="col">Role</th>
                <th scope="col">Posts</th>
                <th scope="col">Created at</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                    <td class="align-middle"><img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" class="rounded-circle" style="width: 35px"></td>
                    <td class="align-middle"><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->roles->implode(', ') }}</td>
                    <td class="align-middle">{{ $user->posts()->count() }}</td>
                    <td class="align-middle">{{ $user->created_at }}</td>
                    <td class="align-middle">Active</td>
                    <td class="align-middle">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-{{ $user->id }}">
                            <i class="fas fa-toggle-on text-body"></i>
                        </button>
                            
                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deactivate confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to deactivate this user?</p>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" class="rounded-circle mr-3 float-left" style="width: 35px">
                                            <div class="float-left">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custamized">Deactivate</button>
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
        {{ $users->links() }}
@endsection