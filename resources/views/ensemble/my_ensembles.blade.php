@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- @if(session('post-deleted-message'))
                <div class="alert alert-danger">{{ session('post-deleted-message') }}</div>
            @endif --}}

            <h1 class="mb-4">My ensembles</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Headline</th>
                        <th scope="col">Piece</th>
                        <th scope="col">Composer</th>
                        <th scope="col">Applications</th>
                        <th scope="col">Dealine</th>
                        <th scope="col">Created at</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ensembles as $ensemble)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td><a href="{{ route('ensemble.show', $ensemble->id) }}">{{ $ensemble->headline }}</a></td>
                            <td>{{ $ensemble->piece }}</td>
                            <td>{{ $ensemble->composer }}</td>

                            <!-- Link trigger ensemble application modal -->
                            <td>
                                <a href="#" data-toggle="modal" data-target="#ensemble-applications-modal-{{ $ensemble->id }}">{{ $ensemble->ensembleApplications->count() }}</a>
                            </td>
                            <!-- Ensemble application modal -->
                            <div class="modal fade" id="ensemble-applications-modal-{{ $ensemble->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ensemble applications</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @forelse($ensemble->ensembleApplications as $ensembleApplication)
                                                <div class="row d-flex align-items-center mb-2">
                                                    <img class="col-sm-1 rounded-circle" src="{{ asset('storage/'.$ensembleApplication->user->avatar) }}" alt="avatar" style="width:25px">
                                                    <div class="col-sm-3"><a href="{{ route('user.show', $ensembleApplication->user_id) }}">{{ $ensembleApplication->user->name }}</a></div>
                                                    <div class="col-sm-2">{{ $ensembleApplication->instrument }}</div>
                                                    <div class="col-sm-3">{{ $ensembleApplication->created_at }}</div>
                                                    <div class="col-sm-2"><a href="#collapseEnsembleAllicationNotes_{{ $ensembleApplication->id }}" data-toggle="collapse">Read notes</a></div>

                                                    <div class="col-sm-1"><a href="{{ $ensembleApplication->recording_url }}" target="_blank" class="text-body"><i class="fas fa-headphones-alt"></i></a></div>
                                                </div>

                                                <!-- Collapsed ensemble application notes area -->
                                                <div class="collapse mb-2" id="collapseEnsembleAllicationNotes_{{ $ensembleApplication->id }}">
                                                    <div class="row">
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-11 border-left">{{ $ensembleApplication->notes }}</div>
                                                    </div>
                                                </div>

                                            @empty
                                                <div class="text-muted">No applications yet.</div>
                                            @endforelse
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <td>{{ $ensemble->deadline }}</td>
                            <td>{{ $ensemble->created_at }}</td>
                            <td><a href="#"><i class="far fa-edit text-body"></i></a></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#deleteEnsembleModal_{{ $ensemble->id }}">
                                    <i class="far fa-trash-alt text-body"></i>
                                </button>
                                    
                                <!-- Modal -->
                                {{-- <div class="modal fade" id="modal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <div class="mb-2 px-3 border-left">{{ $post->title }}</div>
                                                <div class="mb-1">Content</div>
                                                <div class="px-3 border-left">{{ Str::limit($post->content, 200, '...') }}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger-custamized">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $ensembles->links() }}
        </div>
    </div>
</div>

@endsection