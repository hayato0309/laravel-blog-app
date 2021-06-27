@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('user-profile-updated-message'))
                <div class="alert alert-success">{{session('user-profile-updated-message')}}</div>
            @endif
            <h1>Profile</h1>
            <form action="{{route('user.update', $auth->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <img class="rounded" src="{{asset('storage/'.$auth->avatar)}}" alt="avatar" style="width:40%">
                <div class="form-group">
                    <input type="file" class="form-control-file mt-2" name="avatar">
                    
                    @if($errors->has('avatar'))
                        <p class="text-danger">{{$errors->first('avatar')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name',$auth->name)}}">
                    
                    @if($errors->has('name'))
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" value="{{old('email',$auth->email)}}">
                    
                    @if($errors->has('email'))
                        <p class="text-danger">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection