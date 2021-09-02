@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Display messages --}}
            <div class="rounded bg-white p-3 mb-3 overflow-auto" style="height: 80vh;">
                <div class="clearfix">
                    <div class="float-left rounded-pill bg-light p-2 m-2 shadow-sm">
                        Hello
                    </div>
                </div>
                <div class="clearfix">
                    <div class="float-right rounded-pill bg-primary text-white px-3 py-2 m-2 shadow-sm">
                        Hello reply
                    </div>
                </div>
            </div>

            {{-- Chat form --}}
            <form action="" class="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Aa" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection