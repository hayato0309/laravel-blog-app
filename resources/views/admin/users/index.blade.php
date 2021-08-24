@extends('layouts.admin')

@section('admin.content')
    @if(session('user-deactivated-message'))
        <div class="alert alert-danger">{{ session('user-deactivated-message') }}</div>
    @elseif(session('user-activated-message'))
        <div class="alert alert-success">{{ session('user-activated-message') }}</div>
    @endif

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
                    <td class="align-middle">
                        @foreach ($user->roles as $role)
                            <div class="badge badge-pill badge-secondary px-2 py-1">{{ $role->name }}</div>
                        @endforeach
                    </td>
                    <td class="align-middle">{{ $user->posts()->count() }}</td>
                    <td class="align-middle">{{ $user->created_at }}</td>
                    <td class="align-middle">
                        @if($user->trashed())
                            <div class="text-danger">Deactivated</div>    
                        @else    
                            <div>Active</div>    
                        @endif
                    </td> 
                    <td class="align-middle">
                        <div class="dropdown">
                            <a class="btn btn-link p-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h text-body"></i>
                            </a>
                            
                            <div class="dropdown-menu-right dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @if($user->trashed())
                                    {{-- Trigger modal to activate / deactivate the user --}}
                                    <div class="dropdown-item" data-toggle="modal" data-target="#modal-activate-{{ $user->id }}" style="cursor: pointer;">Activate</div>
                                @else
                                    {{-- Trigger modal to activate / deactivate the user --}}
                                    <div class="dropdown-item" data-toggle="modal" data-target="#modal-deactivate-{{ $user->id }}" style="cursor: pointer;">Deactivate</div>
                                @endif

                                {{-- Trigger modal to assign roles to the user --}}
                                <div class="dropdown-item" data-toggle="modal" data-target="#modal-assign-roles-{{ $user->id }}" style="cursor: pointer;">Assign roles</div>
                            </div>
                        </div>
                            
                        <!-- Modal for deactivating users -->
                        <div class="modal fade" id="modal-deactivate-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <form action="{{ route('admin.deactivateUser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custamized">Deactivate</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for activating users -->
                        <div class="modal fade" id="modal-activate-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Activate confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to activate this user?</p>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" class="rounded-circle mr-3 float-left" style="width: 35px">
                                            <div class="float-left">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.activateUser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary">Activate</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for assigning roles -->
                        <div class="modal fade" id="modal-assign-roles-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Assign roles</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.updateRoles', $user->id) }}" method="POST">
                                        <div class="modal-body">
                                            <div class="mb-3">Which roles do you want to assign?</div class="mb-3">
                                            <div>
                                                @foreach($roles as $role)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="roles[]" id="inlineCheckbox1" value="{{ $role->id }}" {{ in_array($role->id, $user->current_role_ids) ? "checked" : "" }}>
                                                        <label class="form-check-label" for="inlineCheckbox1">{{ $role->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Close</button>
                                                @csrf
                                                @method('POST')
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
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