@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{route('home')}}" class="text-body"><i class="fas fa-home"></i></a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{$post->title}}</a>
            </div>
            <div class="">
                <h1 class="mb-4">{{$post->title}}</h1>
                <div class="mb-4">{{$post->content}}</div>
                <div class="text-right mb-4">
                    <div class="d-inline mr-3">
                        <i class="far fa-heart text-muted"></i>
                        <span class="text-muted">123</span>
                    </div>
                    <div class="d-inline text-muted">Posted by <a href="#" class="text-muted">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</div>
                </div>
            </div>
            @if($post->post_image)
                <img class="rounded" src="{{asset('storage/'.$post->post_image)}}" alt="avatar" style="height:20%">
            @endif
        </div>
    </div>
</div>

@endsection