@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            {{-- @if(session('comment-posted-message'))
                <div class="alert alert-success">{{ session('comment-posted-message') }}</div>
            @elseif(session('comment-updated-message'))
                <div class="alert alert-success">{{ session('comment-updated-message') }}</div>
            @elseif(session('comment-deleted-message'))
                <div class="alert alert-danger">{{ session('comment-deleted-message') }}</div>
            @endif --}}

            {{-- Breadcrumb list --}}
            {{-- <div class="mb-4">
                <a href="{{ route('home') }}" class="text-body"><i class="fas fa-home"></i></a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{ $post->title }}</a>
            </div> --}}
            
            <div class="mb-3 p-4 bg-white rounded shadow-sm">
                <div class="row">
                    <h1 class="col-md-10 mb-4">{{ $ensemble->headline }}</h1>

                    <div class="col-md-2 text-right">
                        @if($ensemble->status === "open")
                            <h5><span class="badge badge-pill badge-primary text-white border px-3 py-2">{{ Str::upper($ensemble->status) }}</span></h5>
                        @elseif($ensemble->status === "canceled")
                            <h5><span class="badge badge-pill badge-danger text-white border px-3 py-2">{{ Str::upper($ensemble->status) }}</span></h5>
                        @elseif($ensemble->status === "close")
                            <h5><span class="badge badge-pill badge-dark text-white border px-3 py-2">{{ Str::upper($ensemble->status) }}</span></h5>
                        @endif
                    </div>

                </div>
                <div class="text-muted">Until {{ $ensemble->deadline }}</div>
                <div class="mb-3">{{ $ensemble->introduction }}</div>
                <div><i class="fas fa-music mr-2"></i>{{ $ensemble->piece }}</div>
                <div><i class="fas fa-pencil-alt mr-2"></i>{{ $ensemble->composer }}</div>
                <div class="mb-3"><a href="{{ $ensemble->music_sheet }}" target="_blank">Access the music sheet from here</a></div>
                <div class="mb-1">Notes</div>
                <div class="bg-light p-3 rounded mb-3">{{ $ensemble->notes }}</div>

                <div class="mb-1">I'm looking for ...</div>
                <div class="row mr-auto mb-3">
                    <div class="col-sm-3 pr-0">
                        <div class="rounded bg-secondary text-white text-center mb-3">String</div>
                        <div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Violin</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="violin" placeholder="0" value="{{ $ensemble->violin }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Viola</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="viola" placeholder="0" value="{{ $ensemble->viola }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Cello</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="cello" placeholder="0" value="{{ $ensemble->cello }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Contrabass</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="contrabass" placeholder="0" value="{{ $ensemble->contrabass }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 pr-0">
                        <div class="rounded bg-secondary text-white text-center mb-3">Woodwind</div>
                        <div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Flute</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="flute" placeholder="0" value="{{ $ensemble->flute }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Oboe</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="oboe" placeholder="0" value="{{ $ensemble->oboe }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Clarinet</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="clarinet" placeholder="0" value="{{ $ensemble->clarinet }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Bassoon</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="bassoon" placeholder="0" value="{{ $ensemble->bassoon }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Saxophone</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="saxophone" placeholder="0" value="{{ $ensemble->saxophone }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 pr-0">
                        <div class="rounded bg-secondary text-white text-center mb-3">Brass</div>
                        <div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Trumpet</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="trumpet" placeholder="0" value="{{ $ensemble->trumpet }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Horn</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="horn" placeholder="0" value="{{ $ensemble->horn }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Trombone</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="trombone" placeholder="0" value="{{ $ensemble->trombone }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Tuba</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="tuba" placeholder="0" value="{{ $ensemble->tuba }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 pr-0">
                        <div class="rounded bg-secondary text-white text-center mb-3">Others</div>
                        <div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Piano</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="piano" placeholder="0" value="{{ $ensemble->piano }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Harp</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="harp" placeholder="0" value="{{ $ensemble->harp }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Timpani</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="timpani" placeholder="0" value="{{ $ensemble->timpani }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Snare drum</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="snare_drum" placeholder="0" value="{{ $ensemble->snare_drum }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Bass drum</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="bass_drum" placeholder="0" value="{{ $ensemble->bass_drum }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Tambourine</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="tambourine" placeholder="0" value="{{ $ensemble->tambourine }}" readonly>
                            </div>
                            <div class="row mr-auto">
                                <label class="col-sm-9">Triangle</label>
                                <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="triangle" placeholder="0" value="{{ $ensemble->triangle }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 text-muted text-right">{{ $ensemble->created_at->diffForHumans() }} by <a href="{{ route('user.show', $ensemble->user->id) }}" class="text-muted">{{ $ensemble->user->name }}</a></div>

                <a class="btn btn-outline-dark btn-lg btn-block mb-2" data-toggle="collapse" href="#collapse-submit-recording-textarea" role="button" aria-expanded="false" aria-controls="collapse-submit-recording-textarea">
                    I want to join <i class="far fa-hand-point-down"></i>
                </a>
                <div class="collapse" id="collapse-submit-recording-textarea">
                    <form action="" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <label for="instrument">What is your instrument?</label>
                            <input type="text" class="form-control mb-2" name="instrument" {{ $ensemble->status !== "open" ? "disabled" : "" }}>

                            <label for="recording_url">Recording URL (e.g. Google Drive)</label>
                            <textarea type="text" class="form-control mb-1 {{ $errors->has('content')?'is-invalid':'' }}" name="recording_url" rows="2" placeholder="Please input the URL for the recording_url." {{ $ensemble->status !== "open" ? "disabled" : "" }}>{{ old('recording') }}</textarea>
                        
                            @if($errors->has('content'))
                                <p class="text-danger">{{ $errors->first('content') }}</p>
                            @endif

                            <button type="submit" class="btn btn-primary" {{ $ensemble->status !== "open" ? "disabled" : "" }}>Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Comments textarea --}}
            <div>
                <div class="text-muted text-right">
                    <i class="far fa-comment-alt"></i>
                    <span>Comment / Question</span>
                </div>
                <form action="" method="POST">
                    @csrf
                    @method('POST')
                    <textarea type="text" class="form-control mb-2 {{ $errors->has('content')?'is-invalid':'' }}" name="content" cols="30" rows="3" placeholder="Please write your comment / question." {{ $ensemble->status !== "open" ? "disabled" : "" }}>{{ old('content') }}</textarea>
                    @if($errors->has('content'))
                        <p class="text-danger">{{ $errors->first('content') }}</p>
                    @endif
                    <button type="submit" class="btn btn-primary" {{ $ensemble->status !== "open" ? "disabled" : "" }}>Submit</button>
                </form>
            </div>
            
            
        </div>
    </div>
</div>

@endsection