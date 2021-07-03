@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Session messages --}}
            @if(session('user-profile-updated-message'))
                <div class="alert alert-success">{{session('user-profile-updated-message')}}</div>
            @endif
            @if(session('updated-password'))
                <div class="alert alert-success">{{session('updated-password')}}</div>
            @endif

            <h1>Profile</h1>
            <form action="{{route('user.update', $auth->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <img class="rounded" src="{{asset('storage/'.$auth->avatar)}}" alt="avatar" style="width:30%">
                <div class="form-group">
                    <input type="file" class="form-control-file mt-2" name="avatar">
                    
                    @if($errors->has('avatar'))
                        <p class="text-danger">{{$errors->first('avatar')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" name="name" value="{{old('name',$auth->name)}}">
                    
                    @if($errors->has('name'))
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" name="email" value="{{old('email',$auth->email)}}">
                    
                    @if($errors->has('email'))
                        <p class="text-danger">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

                {{-- Link to update_password page --}}
                <a href="{{route('user.editPassword', $auth->id)}}" class="float-right">Update passward?</a>
            </form>
        </div>
    </div>
</div>

@endsection