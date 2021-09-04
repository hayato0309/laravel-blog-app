<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return view('chats.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'message' => ['required', 'max:1000'],
        ]);

        $input['user_id'] = auth()->user()->id;
        $input['user_name'] = auth()->user()->name;
        $input['avatar'] = auth()->user()->avatar;

        Message::create($input);

        return back();
    }

    public function getMessages()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();
        $json = ["messages" => $messages];
        return response()->json($json);
    }
}
