<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnsembleApplication;

class EnsembleApplicationController extends Controller
{
    public function store($ensemble_id)
    {
        $input = request()->validate([
            'instrument' => ['required'],
            'recording_url' => ['required'],
            'notes' => ['max:3000'],
        ]);

        $input['user_id'] = auth()->user()->id;
        $input['ensemble_id'] = $ensemble_id;

        $ensemble_application = EnsembleApplication::create($input);

        session()->flash('applied-to-ensemble-message', 'You applied to the ensemble successfully. Your instrument is ' . $ensemble_application->instrument);

        return back();
    }
}
