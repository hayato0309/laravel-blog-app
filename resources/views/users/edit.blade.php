@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Session messages --}}
            @if(session('user-profile-updated-message'))
                <div class="alert alert-success">{{ session('user-profile-updated-message') }}</div>
            @endif
            @if(session('updated-password'))
                <div class="alert alert-success">{{ session('updated-password') }}</div>
            @endif

            {{-- Breadcrumb list --}}
            <div class="mb-4">
                <a href="{{ route('home') }}" class="text-body"><i class="fas fa-home"></i></a>
                <i class="fas fa-caret-right"></i>
                <a href="{{ route('user.show', $user->id) }}" class="text-body">{{ $user->name }}'s profile</a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">Edit profile</a>
            </div>

            <h1 class="mb-4">Edit profile</h1>
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <img class="rounded shadow-sm" src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" style="width:30%">
                <div class="form-group">
                    <input type="file" class="form-control-file mt-2" name="avatar">
                    
                    @if($errors->has('avatar'))
                        <p class="text-danger">{{ $errors->first('avatar') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" name="name" value="{{ old('name',$user->name) }}">
                    
                    @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email',$user->email) }}">
                    
                    @if($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Greeting</label>
                    <textarea type="text" class="form-control {{ $errors->has('greeting')?'is-invalid':'' }}" name="greeting" rows="2">{{ old('greeting',$user->greeting) }}</textarea>
                    
                    @if($errors->has('greeting'))
                        <p class="text-danger">{{ $errors->first('greeting') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Interests</label>
                    <textarea type="text" class="form-control {{ $errors->has('interests')?'is-invalid':'' }}" name="interests" rows="2">{{ old('interests',$user->interests) }}</textarea>
                    
                    @if($errors->has('interests'))
                        <p class="text-danger">{{ $errors->first('interests') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>


                {{-- Link to update_password page --}}
                <a href="{{ route('user.editPassword', $user->id) }}" class="float-right">Update passward?</a>
            </form>
        </div>
    </div>
</div>

@endsection