@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('post-updated-message'))
                <div class="alert alert-success">{{ session('post-updated-message') }}</div>
            @endif

            {{-- Breadcrumb list --}}
            <div class="mb-4">
                <a href="{{ route('post.list') }}" class="text-body">My posts</a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{$post->title}}</a>
            </div>

            <h1>Edit the post</h1>
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Post type</label>
                    <select class="form-control {{ $errors->has('post_type_id')?'is-invalid':'' }}" name="post_type_id" readonly>
                        <option value="{{ $post->postType->name }}">{{ $post->postType->name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control {{ $errors->has('title')?'is-invalid':'' }}" name="title" value="{{ $post->title }}">
                    
                    @if($errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea type="text" class="form-control {{ $errors->has('content')?'is-invalid':'' }}" name="content" cols="30" rows="10">{{ $post->content }}</textarea>
                    
                    @if($errors->has('content'))
                        <p class="text-danger">{{ $errors->first('content') }}</p>
                    @endif
                </div>
                
                <img class="rounded" src="{{ asset('storage/'.$post->post_image) }}" alt="post_image" style="width:30%">
                <div class="form-group">
                    <input type="file" class="form-control-file mt-2" name="post_image">
                </div>

                <div class="custom-control custom-checkbox mb-4 p-0">
                    <div class="mb-2">Categories</div>

                    {{-- Checked only the categories already chceked for the post --}}
                    @foreach($categories as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="inlineCheckbox1" value="{{ $category->id }}" {{ in_array($category->id, $current_categories_id) ? "checked" : "" }}>
                            <label class="form-check-label" for="inlineCheckbox1">{{ $category->name }}</label>
                        </div>
                    @endforeach
                    
                    @if($errors->has('categories[]'))
                        <p class="text-danger">{{$errors->first('categories[]')}}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection