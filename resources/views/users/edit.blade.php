@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Profile</h1>
            <form action="" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{$auth->name}}">
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" value="{{$auth->email}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection