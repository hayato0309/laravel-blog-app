@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Display messages --}}
            <div class="rounded bg-white p-4 mb-3 overflow-auto" id="messages" style="height: 80vh;">
                {{-- display messages gotten by message.js --}}
            </div>

            {{-- Chat form --}}
            <form action="{{ route('chat.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="message" class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" placeholder="Aa">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
                @if($errors->has('message'))
                    <p class="text-danger">{{ $errors->first('message') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/message.js') }}"></script>
@endsection