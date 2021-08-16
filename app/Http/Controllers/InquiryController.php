<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inquiry;

class InquiryController extends Controller
{
    public function create()
    {
        return view('inquiries.create');
    }

    public function store()
    {
        $input = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'inquiry_image' => ['file', 'image', 'max:1024'],
        ]);

        $inquiry = new Inquiry();
        $inquiry->user_id = auth()->user()->id;
        $inquiry->title = $input['title'];
        $inquiry->content = $input['content'];

        if (request('inquiry_image')) {
            $inquiry['inquiry_image'] = request('inquiry_image')->store('images');
        }

        $inquiry->save();

        session()->flash('inquiry-submitted-message', 'Your inquiry was submitted successfully. : ' . $inquiry->title);

        return redirect('home');
    }
}
