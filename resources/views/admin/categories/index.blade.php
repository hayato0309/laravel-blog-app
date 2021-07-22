@extends('layouts.admin')

@section('admin.content')
    @if(session('category-created-message'))
        <div class="alert alert-success">{{ session('category-created-message') }}</div>
    @endif

    <h1 class="mb-4">Category list</h1>

    <form action="{{ route('admin.categoryStore') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" name="name" placeholder="Name">

                @if($errors->has('name'))
                    <p class="text-danger">{{$errors->first('name')}}</p>
                @endif
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection