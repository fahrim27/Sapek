<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
use App\ContactUs;
use App\Mail\ContactMail;
use App\Http\Requests\StoreContactUsRequest;

class NewsController extends Controller
{
    public function subs(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        if ( ! Newsletter::isSubscribed($request->email) ) 
        {
            Newsletter::subscribe($request->email);
            return back()->withInfo('success', 'Thanks For Subscribe');
        }
        return back()->withInfo('failure', 'Sorry! You have already subscribed ');       
    }

    public function cont_Index()
    {
    	return view ('common.contactUs');
    }

    public function cont_Store(StoreContactUsRequest $request)
    {   
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

    	$email = new Contact;
    	$email->first_name = $request->first_name;
        $email->last_name = $request->last_name;
    	$email->email = $request->email;
    	$email->subject = $request->subject;
    	$email->message = $request->message;

    	$email->save();

    	Mail::send(new ContactMail($request));

    	return back()->withInfo('Terimkasih telah mengontak kami, Email anda akan dibalas selambat-lambatnya dalam 3 hari kerja');
    }

    public function faq ()
    {
        return view('common.faq');
    }
}
