<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ensemble;

class EnsembleController extends Controller
{
    public function home()
    {
        $ensembles = Ensemble::orderBy('created_at', 'desc')->paginate(10);

        $num_of_open_ensembles = Ensemble::where('status', 'open')->count();

        return view('ensembles.home', compact('ensembles', 'num_of_open_ensembles'));
    }


    public function create()
    {
        return view('ensembles.create');
    }


    public function store()
    {
        $input = request()->validate([
            'headline' => ['required', 'min:3', 'max:100'],
            'introduction' => ['required', 'min:3', 'max:300'],
            'piece' => ['required', 'min:3', 'max:100'],
            'composer' => ['required', 'min:3', 'max:100'],
            'music_sheet' => ['required'],

            'violin' => ['max:2'],
            'viola' => ['max:2'],
            'cello' => ['max:2'],
            'contrabass' => ['max:2'],

            'flute' => ['max:2'],
            'oboe' => ['max:2'],
            'clarinet' => ['max:2'],
            'bassoon' => ['max:2'],
            'saxophone' => ['max:2'],

            'trumpet' => ['max:2'],
            'horn' => ['max:2'],
            'trombone' => ['max:2'],
            'tuba' => ['max:2'],

            'piano' => ['max:2'],
            'harp' => ['max:2'],
            'timpani' => ['max:2'],
            'snare_drum' => ['max:2'],
            'bass_drum' => ['max:2'],
            'tambounrine' => ['max:2'],
            'triangle' => ['max:2'],

            'deadline' => ['required'],
            'notes' => ['max:2000'],
        ]);

        $input['user_id'] = auth()->user()->id;

        $ensemble = Ensemble::create($input);

        session()->flash('ensemble-created-message', 'Ensemble was created successfully. : ' . $ensemble->headline);

        return back();
    }


    public function edit($id)
    {
        $ensemble = Ensemble::findOrFail($id);

        return view('ensembles.edit', compact('ensemble'));
    }


    public function update($id)
    {
        $input = request()->validate([
            'headline' => ['required', 'min:3', 'max:100'],
            'introduction' => ['required', 'min:3', 'max:300'],
            'piece' => ['required', 'min:3', 'max:100'],
            'composer' => ['required', 'min:3', 'max:100'],
            'music_sheet' => ['required'],

            'violin' => ['max:2'],
            'viola' => ['max:2'],
            'cello' => ['max:2'],
            'contrabass' => ['max:2'],

            'flute' => ['max:2'],
            'oboe' => ['max:2'],
            'clarinet' => ['max:2'],
            'bassoon' => ['max:2'],
            'saxophone' => ['max:2'],

            'trumpet' => ['max:2'],
            'horn' => ['max:2'],
            'trombone' => ['max:2'],
            'tuba' => ['max:2'],

            'piano' => ['max:2'],
            'harp' => ['max:2'],
            'timpani' => ['max:2'],
            'snare_drum' => ['max:2'],
            'bass_drum' => ['max:2'],
            'tambounrine' => ['max:2'],
            'triangle' => ['max:2'],

            'deadline' => ['required'],
            'notes' => ['max:2000'],
        ]);

        Ensemble::findOrFail($id)->update($input);

        session()->flash('ensemble-updated-message', 'The ensemble was updated successfully. : ' . $input['headline']);

        return back();
    }


    public function show($id)
    {
        $ensemble = Ensemble::findOrFail($id);

        return view('ensembles.show', compact('ensemble'));
    }


    public function myEnsembles()
    {
        $ensembles = Ensemble::where('user_id', auth()->user()->id)->orderBy('deadline', 'asc')->paginate(10);

        return view('ensembles.my_ensembles', compact('ensembles'));
    }
}
