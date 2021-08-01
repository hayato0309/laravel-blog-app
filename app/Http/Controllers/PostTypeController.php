<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    public function index()
    {
        return view('admin.postTypes.index');
    }
}
