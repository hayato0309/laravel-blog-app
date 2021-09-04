@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            @if(session('applied-to-ensemble-message'))
                <div class="alert alert-success">{{ session('applied-to-ensemble-message') }}</div>
            @elseif(session('comment-posted-message'))
                <div class="alert alert-success">{{ session('comment-posted-message') }}</div>
            @endif

            {{-- Breadcrumb list --}}
            <div class="mb-4">
                <a href="{{ route('ensemble.home') }}" class="text-body">Ensembles</a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">{{ $ensemble->headline }}</a>
            </div>
            
            <div class="mb-3 p-4 bg-white rounded shadow-sm">
                <div class="row">
                    <h1 class="col-md-10 mb-4">{{ $ensemble->headline }}</h1>

                    <div class="col-md-2 text-right">
                        @if($ensemble->trashed())
                            <h5><span class="badge badge-pill badge-dark text-white border px-3 py-2">Close</span></h5>
                        @else
                            <h5><span class="badge badge-pill badge-primary text-white border px-3 py-2">Open</span></h5>
                        @endif
                    </div>

                </div>
                <div class="text-right mb-3">
                    <div class="text-muted">Until {{ $ensemble->deadline }}</div>
                    @if($ensemble->ensembleApplications->count() > 0)
                        <div class="text-danger"><i class="fas fa-fire-alt mr-1"></i>{{ $ensemble->ensembleApplications->count() }} applications now</div>
                    @else
                        <div class="text-muted"><i class="fas fa-fire-alt mr-1"></i>No applications yet</div>
                    @endif
                </div>
                <div class="mb-3">{{ $ensemble->introduction }}</div>
                <div><i class="fab fa-itunes-note mr-2"></i>{{ $ensemble->piece }}</div>
                <div><i class="far fa-user mr-2"></i>{{ $ensemble->composer }}</div>
                <div class="mb-3"><i class="far fa-file-alt mr-2"></i><a href="{{ $ensemble->music_sheet }}" target="_blank">Access the music sheet from here</a></div>
                <div class="mb-1">Notes</div>
                <div class="bg-light p-3 rounded mb-3">
                    @empty($ensemble->notes)
                        <div class="text-muted">No notes for this ensemble.</div>
                    @else
                        <div>{{ $ensemble->notes }}</div>
                    @endempty
                </div>

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


                {{-- For application to ensemble --}}
                <a class="btn btn-outline-dark btn-lg btn-block mb-2" data-toggle="collapse" href="#collapse-submit-recording-textarea" role="button" aria-expanded="false" aria-controls="collapse-submit-recording-textarea">
                    I want to join <i class="far fa-hand-point-down"></i>
                </a>
                <div class="collapse" id="collapse-submit-recording-textarea">
                    <form action="{{ route('ensembleApplication.store', $ensemble->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <label for="instrument">What is your instrument?</label>
                            <input type="text" class="form-control mb-2" name="instrument" {{ $ensemble->trashed() ? "disabled" : "" }}>
                            @if($errors->has('recording_url'))
                                <p class="text-danger">{{ $errors->first('recording_url') }}</p>
                            @endif

                            <label for="recording_url">Recording URL (e.g. Google Drive)</label>
                            <textarea type="text" class="form-control mb-2 {{ $errors->has('content')?'is-invalid':'' }}" name="recording_url" rows="2" placeholder="Please input the URL for the recording URL." {{ $ensemble->trashed() ? "disabled" : "" }}>{{ old('recording_url') }}</textarea>
                            @if($errors->has('recording_url'))
                                <p class="text-danger">{{ $errors->first('recording_url') }}</p>
                            @endif

                            <label for="notes">Notes</label>
                            <textarea type="text" class="form-control mb-2 {{ $errors->has('content')?'is-invalid':'' }}" name="notes" rows="2" placeholder="Please input here if you have some notes." {{ $ensemble->trashed() ? "disabled" : "" }}>{{ old('notes') }}</textarea>
                            @if($errors->has('notes'))
                                <p class="text-danger">{{ $errors->first('notes') }}</p>
                            @endif

                            <button type="submit" class="btn btn-primary" {{ $ensemble->trashed() ? "disabled" : "" }}>Submit</button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Comments display area --}}
            @foreach($comments as $comment)
                <div class="rounded shadow-sm p-3 bg-white">
                    <div class="d-inline-block h-auto w-100 mb-1">
                        <img class="rounded-circle float-left mr-2" src="{{ asset('storage/'.$comment->user->avatar) }}" alt="comment-user-image" style="width:45px">
                        <div class="float-left">
                            <div><a href="{{ route('user.show', $comment->user->id) }}" class="text-body">{{ $comment->user->name }}</a></div>
                            <div class="text-muted">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                        
                        {{-- Edit and delete buttons - Parent comment --}}
                        @if($comment->user_id == Auth::user()->id)
                        <div class="text-right">
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#parent-comment-edit-modal-{{ $comment->id }}">
                                <i class="far fa-edit mr-1 text-body"></i>
                            </button>
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#parent-comment-delete-modal-{{ $comment->id }}">
                                <i class="far fa-trash-alt text-body"></i>
                            </button>
                        </div>
                        @endif
                        
                    </div>
                    <div class="border-left px-3">{{ $comment->comment }}</div>
                </div>
            @endforeach

            {{-- Comments textarea --}}
            <div>
                <div class="text-muted text-right">
                    <i class="far fa-comment-alt"></i>
                    <span>Comment</span>
                </div>
                <form action="{{ route('comment.storeCommentForEnsemble', ['ensemble_id' => $ensemble->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <textarea type="text" class="form-control mb-2 {{ $errors->has('comment')?'is-invalid':'' }}" name="comment" cols="30" rows="3" placeholder="Please write your comment.">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                        <p class="text-danger">{{ $errors->first('comment') }}</p>
                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
            
        </div>
    </div>
</div>

@endsection