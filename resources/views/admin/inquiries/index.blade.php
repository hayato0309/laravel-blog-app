@extends('layouts.admin')

@section('admin.content')
    {{-- @if(session('user-deactivated-message'))
        <div class="alert alert-danger">{{ session('user-deactivated-message') }}</div>
    @elseif(session('user-activated-message'))
        <div class="alert alert-success">{{ session('user-activated-message') }}</div>
    @endif --}}

    <h1 class="mb-4">Inquiries</h1>

    <form action="{{ route('admin.inquiries') }}" method="GET" class="form-inline mb-4">
        <div class="form-group">
            <select class="form-control mr-4" name="inquiry_filter">
                <option value="">-</option>
                <option value="">All</option>
                <option value="solved">Solved</option>
                <option value="unsolved">Unsolved</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    
    <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $inquiry)
                    <tr>
                        <td class="align-middle">
                            <button type="button" class="btn btn-link p-0" data-toggle="collapse" data-target="#collapsed_inquiry_{{ $inquiry->id }}">
                                <i class="far fa-plus-square text-body"></i>
                            </button>
                        </td>
                        <td class="align-middle" scope="row">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ Str::limit($inquiry->title, 100, '...') }}</td>
                        <td class="align-middle">{{ $inquiry->created_at }}</td>
                        <td class="align-middle">
                            @if($inquiry->is_solved === 1)
                                <div>Solved</div>
                            @elseif($inquiry->is_solved === 0) 
                                <div class="text-danger">Unsolved</div>
                            @endif
                        </td>
                        <td scope="align-middle">
                                @if($inquiry->is_solved === 1)
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-mark-as-unsolved-{{ $inquiry->id }}">
                                    <i class="fas fa-check-square text-body"></i>
                                </button>
                                @elseif($inquiry->is_solved === 0) 
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#modal-mark-as-solved-{{ $inquiry->id }}">
                                    <i class="far fa-square text-body"></i>
                                </button>
                            @endif
                        </td>
                    </tr>

                    {{-- Collapse part --}}
                    <tr class="collapse" id="collapsed_inquiry_{{ $inquiry->id }}">
                        <td></td>
                        <td colspan="4">
                            <div class="mb-4">{{ $inquiry->title }}</div>
                            <div class="mb-4">{{ $inquiry->content }}</div>

                            @if($inquiry->inquiry_image)
                                <img class="rounded mb-4" src="{{ asset('storage/'.$inquiry->inquiry_image) }}" alt="avatar" style="width:30%">
                            @else
                                <div class="text-muted mb-4">* This inquiry has no image.</div>
                            @endif

                            <div class="text-right">By <a href="{{ route('user.show', $inquiry->user_id) }}">{{ $inquiry->user->name }}</a>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal - mark as Solved --}}
                    <div class="modal fade" id="modal-mark-as-solved-{{ $inquiry->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">Are you sure you want to mark this inquiry as "solved"?</div>
                                    <div class="mb-1">Title</div>
                                    <div class="mb-2 px-3 border-left">{{ $inquiry->title }}</div>
                                    <div class="mb-1">Content</div>
                                    <div class="px-3 border-left">{{ Str::limit($inquiry->content, 200, '...') }}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ route('admin.solveInquiry', $inquiry->id) }}" class="btn btn-primary">Solved</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal - mark as Unsolved --}}
                    <div class="modal fade" id="modal-mark-as-unsolved-{{ $inquiry->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">Are you sure you want to mark this inquiry as "unsolved"?</div>
                                    <div class="mb-1">Title</div>
                                    <div class="mb-2 px-3 border-left">{{ $inquiry->title }}</div>
                                    <div class="mb-1">Content</div>
                                    <div class="px-3 border-left">{{ Str::limit($inquiry->content, 200, '...') }}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ route('admin.unsolveInquiry', $inquiry->id) }}" class="btn btn-danger-custamized">Unsolved</a>
                                </div>
                            </div>
                        </div>
                        </div>

                @endforeach
            </tbody>
        </table>
    {{ $inquiries->links() }}
@endsection