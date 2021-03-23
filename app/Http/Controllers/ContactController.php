<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function evaluationget() {
        return view('evaluation');
    }

    public function evaluationpost(Request $request) {
        // dd($request->all());
        // question2answer

        $rules = [
            'question1answer' => 'required',
            'question2answer' => 'required',
            'question3answer' => 'required',
            'question4answer' => 'required',
            'question5answer' => 'required',
            'question6answer' => 'required',
            'question7answer' => 'required',
            'question8answer' => 'required',
            'question9answer' => 'required',
            'question10answer' => 'required',
            'question11answer' => 'required',
            'strengths' => 'nullable|string',
            'weaknesses' => 'nullable|string',
            'improvements' => 'nullable|string',
        ];

        $data = [
            'question1answer' => $request->input('question1answer'),
            'question2answer' => $request->input('question2answer'),
            'question3answer' => $request->input('question3answer'),
            'question4answer' => $request->input('question4answer'),
            'question5answer' => $request->input('question5answer'),
            'question6answer' => $request->input('question6answer'),
            'question7answer' => $request->input('question7answer'),
            'question8answer' => $request->input('question8answer'),
            'question9answer' => $request->input('question9answer'),
            'question10answer' => $request->input('question10answer'),
            'question11answer' => $request->input('question11answer'),
            'strengths' => $request->input('strengths'),
            'weaknesses' => $request->input('weaknesses'),
            'improvements' => $request->input('improvements'),
        ];

        //validate
        $validatedData = $this->validate($request, $rules);
        // dd(count($request->all()));

        //store evaluation
        Evaluation::create([
            'user_id' =>Auth::user()->user_id,
            'answer1' => $data['question1answer'],
            'answer2' => $data['question2answer'],
            'answer3' => $data['question3answer'],
            'answer4' => $data['question4answer'],
            'answer5' => $data['question5answer'],
            'answer6' => $data['question6answer'],
            'answer7' => $data['question7answer'],
            'answer8' => $data['question8answer'],
            'answer9' => $data['question9answer'],
            'answer10' => $data['question10answer'],
            'answer11' => $data['question11answer'],
            'strengths' => $data['strengths'],
            'weaknesses' => $data['weaknesses'],
            'improvement' => $data['improvements'],
        ]);

        //redirect
        Session::flash('message', 'Thank you. Your feedback was received!'); 
        return back();
    }
}
