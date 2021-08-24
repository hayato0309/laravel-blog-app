@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('ensemble-created-message'))
                <div class="alert alert-success">{{ session('ensemble-create-message') }}</div>
            @endif

            {{-- Breadcrumb list --}}
            <div class="mb-4">
                <a href="{{ route('ensemble.home') }}" class="text-body">Ensembles</a>
                <i class="fas fa-caret-right"></i>
                <a href="#" class="text-body">Create an ensemble</a>
            </div>

            <h1>Create an ensemble</h1>
            <form action="{{ route('ensemble.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Headline</label>
                    <input type="headline" class="form-control {{ $errors->has('headline')?'is-invalid':'' }}" name="headline" placeholder="e.g. Let's play Beethoven together!" value="{{ old('headline') }}">
                    
                    @if($errors->has('headline'))
                        <p class="text-danger">{{ $errors->first('headline') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Introduction (Max 200 letters)</label>
                    <textarea type="text" class="form-control {{ $errors->has('introduction')?'is-invalid':'' }}" name="introduction" cols="30" rows="3" placeholder="e.g. Thank you for your interest! We gonna play ..." value="">{{ old('introduction') }}</textarea>
                    
                    @if($errors->has('introduction'))
                        <p class="text-danger">{{ $errors->first('introduction') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>What piece do you want to play with other musicians?</label>
                    <input type="text" class="form-control {{ $errors->has('piece')?'is-invalid':'' }}" name="piece" placeholder="e.g. Symphony No.3 (String orchestra ver.)" value="{{ old('piece') }}">
                    
                    @if($errors->has('piece'))
                        <p class="text-danger">{{ $errors->first('piece') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Who is the composer of this piece?</label>
                    <input type="text" class="form-control {{ $errors->has('composer')?'is-invalid':'' }}" name="composer" placeholder="e.g. Beethoven" value="{{ old('composer') }}">
                    
                    @if($errors->has('composer'))
                        <p class="text-danger">{{ $errors->first('composer') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>What music sheet are you going to use?</label>
                    <input type="text" class="form-control {{ $errors->has('music_sheet')?'is-invalid':'' }}" name="music_sheet" placeholder="e.g. https://imslp.org/..." value="{{ old('music_sheet') }}">
                    
                    @if($errors->has('music_sheet'))
                        <p class="text-danger">{{ $errors->first('music_sheet') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>How many musicians do you need?</label>
                    <div class="row mr-auto">
                        <div class="col-sm-3 pr-0">
                            <div class="rounded bg-secondary text-white text-center mb-3">String</div>
                            <div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Violin</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="violin" placeholder="0" value="{{ old('violin') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Viola</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="viola" placeholder="0" value="{{ old('viola') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Cello</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="cello" placeholder="0" value="{{ old('cello') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Contrabass</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="contrabass" placeholder="0" value="{{ old('contrabass') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pr-0">
                            <div class="rounded bg-secondary text-white text-center mb-3">Woodwind</div>
                            <div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Flute</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="flute" placeholder="0" value="{{ old('flute') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Oboe</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="oboe" placeholder="0" value="{{ old('oboe') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Clarinet</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="clarinet" placeholder="0" value="{{ old('clarinet') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Bassoon</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="bassoon" placeholder="0" value="{{ old('bassoon') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Saxophone</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="saxophone" placeholder="0" value="{{ old('saxophone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pr-0">
                            <div class="rounded bg-secondary text-white text-center mb-3">Brass</div>
                            <div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Trumpet</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="trumpet" placeholder="0" value="{{ old('trumpet') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Horn</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="horn" placeholder="0" value="{{ old('horn') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Trombone</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="trombone" placeholder="0" value="{{ old('trombone') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Tuba</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="tuba" placeholder="0" value="{{ old('tuba') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pr-0">
                            <div class="rounded bg-secondary text-white text-center mb-3">Others</div>
                            <div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Piano</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="piano" placeholder="0" value="{{ old('piano') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Harp</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="harp" placeholder="0" value="{{ old('harp') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Timpani</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="timpani" placeholder="0" value="{{ old('timpani') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Snare drum</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="snare_drum" placeholder="0" value="{{ old('snare_drum') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Bass drum</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="bass_drum" placeholder="0" value="{{ old('bass_drum') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Tambourine</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="tambourine" placeholder="0" value="{{ old('tambourine') }}">
                                </div>
                                <div class="row mr-auto">
                                    <label class="col-sm-9">Triangle</label>
                                    <input type="number" min="0" max="10" class="form-control form-control-sm col-sm-3" name="triangle" placeholder="0" value="{{ old('triangle') }}">
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label>Deadline</label>
                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control {{ $errors->has('deadline')?'is-invalid':'' }}" name="deadline" placeholder="e.g. https://imslp.org/..." value="{{ old('deadline') }}">
                    
                    @if($errors->has('dealine'))
                        <p class="text-danger">{{ $errors->first('dealine') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Notes</label>
                    <textarea type="text" class="form-control {{ $errors->has('notes')?'is-invalid':'' }}" name="notes" cols="30" rows="3" placeholder="e.g. tempo, background when they shoot the video, clothes, lighting">{{ old('notes') }}</textarea>
                    
                    @if($errors->has('notes'))
                        <p class="text-danger">{{ $errors->first('notes') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection