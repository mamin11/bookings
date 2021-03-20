<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index() {
        return view('contact');
    }

    public function send(Request $request) {
        //validate
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        //send
        Mail::to('mamindesigns@gmail.com')->send(new ContactEmail($data));

        //redirect
        Session::flash('message', 'your message was successfully sent!'); 
        return back();
    }
}
