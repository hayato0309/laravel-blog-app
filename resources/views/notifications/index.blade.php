@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- @if(session('post-deleted-message'))
                <div class="alert alert-danger">{{ session('post-deleted-message') }}</div>
            @endif --}}

            <h1 class="mb-4">Notifications</h1>
            
            <div>
                <div class="container card p-3 mb-2 border-0 shadow-sm">
                    <div class="row">
                        <div class="col-md-1">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="col-md-8">
                            <span>Hayato followed you.</span>
                        </div>
                        <div class="col-md-3 text-muted">
                            2021-01-01 12:00:00
                        </div>
                    </div>
                </div>
                <div class="container card p-3 mb-2 border-0 shadow-sm">
                    <div class="row">
                        <div class="col-md-1">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="col-md-8">
                            <span>Hayato posted a new atrile. Title</span>
                        </div>
                        <div class="col-md-3 text-muted">
                            2021-01-01 12:00:00
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection