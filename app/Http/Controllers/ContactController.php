<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   	public function postContact(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'name' => 'min:3',
			'msg' => 'min:10']);
		$data = array(
			'email' => $request->email,
			'name' => $request->name,
			'msg' => $request->message
			
			);
		
		Mail::send('emails.contact', $data, function($message) use ($data){
			
			$message->from($data['email']);
			$message->to('celinebourseaux@gmail.com');
			
		});
		Session::flash('success', 'Your Email was Sent!');
		return redirect('/contact');
	}

}
