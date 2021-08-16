@extends('layouts.admin')

@section('admin.content')
    {{-- @if(session('user-deactivated-message'))
        <div class="alert alert-danger">{{ session('user-deactivated-message') }}</div>
    @elseif(session('user-activated-message'))
        <div class="alert alert-success">{{ session('user-activated-message') }}</div>
    @endif --}}

    <h1 class="mb-4">Inquiries</h1>

    <form action="" class="form-inline mb-4">
        <div class="form-group">
            <select class="form-control mr-4" name="">
                <option value="">All</option>
                <option value="">Unsolved</option>
                <option value="">Solved</option>
            </select>
        </div>
        <button class="btn btn-primary">Filter</button>
    </form>
    
    <form action="">
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created at</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inquiries as $inquiry)
                        <tr>
                            <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                            <td class="align-middle">{{ Str::limit($inquiry->title, 100, '...') }}</td>
                            <td class="align-middle">{{ $inquiry->created_at }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="">
                                    <i class="far fa-eye text-body"></i>
                                </button>
                            </td>
                            <th scope="align-middle">
                                <i class="far fa-square"></i>
                                {{-- <i class="fas fa-check-square"></i> --}}
                            </th>
                        @endforeach
                </tbody>
            </table>
    </form>
    {{ $inquiries->links() }}
@endsection