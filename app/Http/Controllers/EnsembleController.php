<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnsembleController extends Controller
{
    public function create()
    {
        return view('ensemble.create');
    }
}
