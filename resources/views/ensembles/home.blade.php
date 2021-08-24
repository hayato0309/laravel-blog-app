@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        {{-- Left sidebar --}}
        <div class="col-md-3 p-3">
            <div class="p-3 mb-3 bg-white rounded">
                <div class="btn-group btn-group-toggle w-100">
                    <a href="{{ route('home') }}" class="btn btn-outline-dark">Articles</a>
                    <a href="#" class="btn btn-outline-dark active">Ensembles</a>
                </div>
            </div>

            <div class="p-3 bg-white rounded">
                <div>{{ $num_of_open_ensembles }} ensembles are open.</div>
            </div>
        </div>

        {{-- Body --}}
        <div class="col-md-9 py-3">
            <div class="clearfix">
                @forelse($ensembles as $ensemble)
                    <a href="{{ route('ensemble.show', $ensemble->id) }}" class="text-body">
                        <div class="card float-left border-0 shadow-sm ml-4 mb-4 p-4" style="width: 47%">
                            <h5>{{ $ensemble->headline }}</h5>
                            <div class="text-muted mb-2">{{ $ensemble->introduction }}</div>
                            <div><i class="fab fa-itunes-note mr-2"></i>{{ $ensemble->piece }}</div>
                            <div><i class="far fa-user mr-2"></i>{{ $ensemble->composer }}</div>
                            <div><i class="far fa-calendar-alt mr-2"></i>{{ $ensemble->deadline }}</div>
                        </div>
                    </a>
                @empty
                    <div class="text-muted">No open ensemble for now.</div>
                @endforelse
            </div>

            <div class="pl-4">{{ $ensembles->links() }}</div>
            
        </div>   
    </div>
</div>
@endsection
