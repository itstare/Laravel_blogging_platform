<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }

    public function send(Request $request){
        $rules = [
            'name' => ['required', 'max:32'],
            'email' => ['required', 'max:32', 'email'],
            'subject' => ['required', 'max:50'],
            'mail_message' => ['required', 'max:2000'],
        ];
        $this->validate($request, $rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'mail_message' => $request->mail_message,
        ];

        Mail::send('contact.email', $data, function($message){ 
            $message->to('tarik.vreto@hotmail.com', 'Tarik')->subject('Mail from contact form');
        });

        Session::flash('contact_sent', 'Thank for contacting us, we will get back to you shortly!');

        return redirect('/');
    }
}
